<?php

namespace App\Repository\Frontend;
use App\Events\CreateOrder;
use App\Notifications\OrderPlaced;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\InterFaces\Frontend\CheckoutRepositoryInterface;
use Illuminate\Support\Facades\Log;

use App\Models\Product;
use App\Models\Shipping;
use App\Models\Order;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class CheckoutRepository implements CheckoutRepositoryInterface{

    public function checkout1()
    {
        $user = Auth::user();
        return view('WebSite.checkout.checkout1',compact('user'));
    }
    public function checkout1Store($request)
    {

        Session::put('checkout' , [
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'country'=>$request->country,
            'address'=>$request->address,
            'city'=>$request->city,
            'state'=>$request->state,
            'postcode'=>$request->postcode,
            'note'=>$request->note,
            'sfirst_name'=>$request->sfirst_name,
            'slast_name'=>$request->slast_name,
            'semail'=>$request->semail,
            'sphone'=>$request->sphone,
            'scountry'=>$request->scountry,
            'saddress'=> $request->saddress,
            'scity'=> $request->scity,
            'sstate'=>$request->sstate,
            'spostcode'=>$request->spostcode,
            'sub_total'=>Cart::instance('shopping')->subtotal(),
            'total_amount'=>$request->total_amount,
        ]);

        $shippings = Shipping::where('status' , 'active')->orderBy('shipping_address' , 'ASC')->get();

        return view('WebSite.checkout.checkout2', compact('shippings'));
    }
    public function checkout2Store($request)
    {

        Session::push('checkout', [
            'delivery_charge' => $request->delivery_charge,
        ]);

        return view('WebSite.checkout.checkout3');
    }
    public function checkout3Store($request)
    {

        Session::push('checkout',[
            'payment_method' => $request->payment_method,
            'payment_status' =>'unpaid',
        ]);

        return view('WebSite.checkout.review');
    }
    public function checkoutStore($request)
    {
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->order_number = Str::upper('ORD-'.Str::random(6));


        $order->sub_total = Cart::instance('shopping')->subtotal();

        $floatValue = floatval(str_replace(',', '', \Gloudemans\Shoppingcart\Facades\Cart::subtotal()));
        $formattedValue = number_format($floatValue, 2, '.', '');

        $order->coupon = Session::has('coupon') ? Session::get('coupon')['value'] : 0;

        if(Session::has('coupon'))
        {
            $order->total_amount = \Helper::return_convert_price($formattedValue + Session::get('checkout')[0]['delivery_charge'] - Session::get('coupon')['value']);

        }else{
            $order->total_amount = \Helper::return_convert_price($formattedValue + Session::get('checkout')[0]['delivery_charge']);
        }

        Helper::currency_load();
        $currency_code = session('currency_code');

        if($currency_code == "")
        {
            $system_default_currency_info = session('system_default_currency_info');
            $currency_code = $system_default_currency_info->code;
        }

        $order->currency = strtolower($currency_code);

        $order->condition = 'pending';
        $order->delivery_charge = \Helper::return_convert_price(Session::get('checkout')[0]['delivery_charge']);
        $order->first_name = Session::get('checkout')['first_name'];
        $order->last_name = Session::get('checkout')['last_name'];
        $order->email = Session::get('checkout')['email'];
        $order->phone = Session::get('checkout')['phone'];
        $order->city = Session::get('checkout')['city'];
        $order->address = Session::get('checkout')['address'];
        $order->note = Session::get('checkout')['note'];
        $order->postcode = Session::get('checkout')['postcode'];
        $order->sfirst_name = Session::get('checkout')['sfirst_name'];
        $order->slast_name = Session::get('checkout')['slast_name'];
        $order->semail = Session::get('checkout')['semail'];
        $order->sphone = Session::get('checkout')['sphone'];
        $order->scountry = Session::get('checkout')['scountry'];
        $order->saddress = Session::get('checkout')['saddress'];
        $order->scity = Session::get('checkout')['scity'];
        $order->sstate = Session::get('checkout')['sstate'];
        $order->spostcode = Session::get('checkout')['spostcode'];

        $order->save();

        foreach (Cart::instance('shopping')->content() as $item)
        {
            $product = Product::find($item->id);
            $order->products()->attach($product, ['quantity' => $item->qty]);
        }

        $order_number = $order->order_number;

        if (Session::get('checkout')[1]['payment_method'] == 'cod')
        {
            $order->payment_method = 'cod';
            $order->payment_status = 'unpaid';

            $status =  $order->save();

            $url = 'http://127.0.0.1:8000/complete-cash/';
            $user = Auth::user();
            Notification::send($user, new OrderPlaced($order_number , $url));

            if ($status)
            {
                Cart::instance('shopping')->destroy();
                Session::forget('coupon');
                Session::forget('checkout');

                $notification = new \App\Models\Notification();
                $notification->order_id = $order->id;
                $notification->username = \auth()->user()->username;
                $notification->message = 'New Order';
                $notification->save();



                $data = [
                    'order_id' => $order->id,
                    'username' => \auth()->user()->username,
                    'message' => 'New Order ',
                    'created_at' => $notification->created_at
                ];

                event(new CreateOrder($data));

                return redirect()->route('complete.cash', ['order' => $order_number]);
            }
            else
            {
                return redirect()->route('checkout1')->with('error', 'Please Try Again');
            }


        }
        elseif (Session::get('checkout')[1]['payment_method'] == 'stripe')
        {
            Stripe::setApiKey(config('services.stripe.secret_key'));
            $amount = (int) round($order->total_amount * 100);

                if(Session::has('coupon'))
                {
                    $amount = $amount - Session::get('coupon')['value'] * 100; // تحويل القيمة من الدولارات إلى السنتات
                }

            $currency = strtolower($currency_code);
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => $currency,
                            'product_data' => [
                                'name' => 'Your Product',
                            ],
                            'unit_amount' => $amount,
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('complete.stripe', $order->order_number),
                'cancel_url' => route('checkout1'),
            ]);


            return redirect()->away($session->url);
        }
    }


    public function completeStripe($order)
    {
        $recent_order = Order::latest()->first();
        $recent_order->payment_method = 'stripe';
        $recent_order->payment_status = 'paid';


        $status =  $recent_order->save();

        $url = 'http://127.0.0.1:8000/complete-stripe/';
        $user = Auth::user();
        Notification::send($user, new OrderPlaced($order , $url));

        Cart::instance('shopping')->destroy();
        Session::forget('coupon');
        Session::forget('checkout');

        if (!$status) {
            return redirect()->route('checkout1')->with('error', 'Please Try Again');
        }

        $notifaction = new \App\Models\Notification();
        $notifaction->order_id = $recent_order->id;
        $notifaction->username = \auth()->user()->username;
        $notifaction->message = 'New Order';

        $notifaction->save();

        $data = [
            'order_id' => $recent_order->id,
            'username' => \auth()->user()->username,
            'message' => 'New Order ',
            'created_at' => $notifaction->created_at
        ];

        event(new CreateOrder($data));

        return view('WebSite.checkout.complete', compact('order'));
    }
    public function completeCashOnDelivery($order)
    {
        return view('WebSite.checkout.complete', compact('order'));
    }


}
