<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Shipping;
use Illuminate\Http\Request;
use App\InterFaces\Frontend\CheckoutRepositoryInterface;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\DeliveryChargeRequest;
use Illuminate\Support\Facades\Validator;


class CheckoutController extends Controller
{
    private $Checkout;

    public function __construct(CheckoutRepositoryInterface $Checkout)
    {
        $this->Checkout = $Checkout;
    }
    public function checkout1(){

        return $this->Checkout->checkout1();
    }
    public function checkout1Store(Request $request)
    {
        $this->validate($request,[
            'first_name' => 'string|required',
            'last_name' => 'string|required',
            'email' => 'email|required|exists:users,email',
            'phone' => 'string|required',
            'address' =>'string|required',
            'city' =>'string|required',
            'country' =>'string|nullable',
            'state' =>'string|nullable',
            'postcode' =>'numeric|nullable',
            'note' =>'string|nullable',
            'saddress' =>'string|required',
            'scity' =>'string|required',
            'scountry' =>'string|nullable',
            'sstate' =>'string|nullable',
            'spostcode' =>'numeric|nullable',
            'sub_total' =>'required',
            'total_amount' =>'required',

        ]);
        return $this->Checkout->checkout1Store($request);
    }

    /**
     * @throws ValidationException
     */
    public function checkout2Store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'delivery_charge' => 'required|numeric',
        ]);

        $shippings = Shipping::where('status' , 'active')->orderBy('shipping_address' , 'ASC')->get();

        if ($validator->fails()) {
            return view('WebSite.checkout.checkout2', compact('shippings'))
                ->withErrors($validator);
        }

        return $this->Checkout->checkout2Store($request);
    }

    /**
     * @throws ValidationException
     */
    public function checkout3Store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
            'payment_method' =>'string|required',
            'payment_status' =>'string|in,paid,unpaid',
        ]);

        if ($validator->fails()) {
            return view('WebSite.checkout.checkout3')
                ->withErrors($validator);
        }

        return $this->Checkout->checkout3Store($request);
    }
    public function checkoutStore(Request $request)
    {
        return $this->Checkout->checkoutStore($request);
    }
    public function completeStripe($order)
    {
        return $this->Checkout->completeStripe($order);
    }

    public function completeCashOnDelivery($order)
    {
        return $this->Checkout->completeCashOnDelivery($order);
    }
}
