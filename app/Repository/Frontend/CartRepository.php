<?php 

namespace App\Repository\Frontend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\InterFaces\Frontend\CartRepositoryInterface;
use Illuminate\Support\Facades\Log; 

use App\Models\Product;
use App\Models\Coupon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartRepository implements CartRepositoryInterface{

    public function cart()
    {
        return view('WebSite.cart.index');
    }
    public function cartStore($request)
    {
        $product_qty = $request->input('product_qty');
        $product_id = $request->input('product_id');
        $product = Product::getProductByCart($product_id);
        $price = $product[0]['offer_price'];

        $cart_array=[];

        foreach(Cart::instance('shopping')->content() as $item)
        {
            $cart_array[] = $item->id;
        }

        $result = Cart::instance('shopping')->add([
        'id' => $product_id,
        'name' => $product[0]['title'],
        'qty' => $product_qty,
        'price' => $price,])->associate('App\Models\Product');

        if($result)
        {
            $response['status'] = true;
            $response['product_id'] = $product_id;
            $response['total'] = Cart::subtotal();
            $response['cart_count'] = Cart::instance('shopping')->count();
            $response['message'] = "Item Was added to your cart";

            try {
                $header = view('WebSite.layouts.header')->render();
                Log::info('Header content:', ['header' => $header]);
                $response['header'] = $header;
            } catch (\Exception $e) {
                Log::error('Error rendering header:', ['error' => $e->getMessage()]);
                $response['header'] = null; 
            }
        }

      
        return response()->json($response); 
    }

    public function cartDelete($request)
    {
        $id = $request->input('cart_id');
        $result = Cart::instance('shopping')->remove($id);
    
        $response = []; 
    
        
        $response['status'] = true;
        $response['message'] = "Cart successfully removed  ";
        $response['total'] = Cart::subtotal();
        $response['cart_count'] = Cart::instance('shopping')->count();
        
        try
        {
            $header = view('WebSite.layouts.header')->render();
            $cart_list = view('WebSite.layouts.cart_list')->render();
            $response['header'] = $header;
            $response['cart_list'] = $cart_list;
        }
        catch (\Exception $e) {
            Log::error('Error rendering header:', ['error' => $e->getMessage()]);
            $response['header'] = null; 
        }
        return response()->json($response);
    }
    public function couponAdd($request)
    {
        $coupon = Coupon::where('code', $request->input('code'))->first();

        if ($coupon) {

            $CartfloatValue = floatval(str_replace(',', '',Cart::instance('shopping')->subtotal()));
            $CartformattedValue = number_format($CartfloatValue, 2, '.', '');

            session()->put('coupon', [
                'id' => $coupon->id,
                'code' => $coupon->code,
                'value' => $coupon->discount($CartformattedValue),
            ]);

            return back()->with('success', 'Coupon applied successfully');
        }

        return back()->with('error', 'Coupon not found');
    }

    
}