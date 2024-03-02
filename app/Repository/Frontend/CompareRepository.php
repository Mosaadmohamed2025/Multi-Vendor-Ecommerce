<?php

namespace App\Repository\Frontend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\Frontend\CompareRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class CompareRepository implements CompareRepositoryInterface{
    public function compare()
    {
        return view('WebSite.compare.index');
    }
    public function compareStore($request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');
        $product = Product::getProductByCart($product_id);
        $price = $product[0]['offer_price'];

        $compare_array=[];

        foreach(Cart::instance('compare')->content() as $item)
        {
            $compare_array[] = $item->id;
        }

        if(in_array($product_id , $compare_array))
        {
            $response['present'] = true;
            $response['message'] = 'Item is already in your compare ';
        }elseif (count($compare_array) >= 4)
        {
            $response['status'] = false;
            $response['message'] = 'You Cant add more than 4 items ';
        }elseif($product[0]['stock'] <= 0)
        {
            $response['status'] = false;
            $response['message'] = 'We dont have enough items';
        }
        else{
            $result = Cart::instance('compare')->add([
                'id' => $product_id,
                'name' => $product[0]['title'],
                'qty' => $product_qty,
                'price' => $price,
            ])->associate('App\Models\Product');
            if($result)
            {
                $response['status'] = true;
                $response['message'] = "Item Was added to your compare";
                $response['compare_count'] = Cart::instance('compare')->count();


                try {
                    $header = view('WebSite.layouts.header')->render();
                    Log::info('Header content:', ['header' => $header]);
                    $response['header'] = $header;
                } catch (\Exception $e) {
                    Log::error('Error rendering header:', ['error' => $e->getMessage()]);
                    $response['header'] = null;
                }
            }
        }

        return response()->json($response);
    }
    public function moveToCart($request)
    {
        $item = Cart::instance('compare')->get($request->input('rowId'));

        Cart::instance('compare')->remove($request->input('rowId'));
        $result  = Cart::instance('shopping')->add($item->id , $item->name , 1 , $item->price)->associate('App\Models\Product');

        if($result)
        {
            $response['status'] = true;
            $response['message'] = "Item has been moved to a cart ";
            try {
                $header = view('WebSite.layouts.header')->render();
                $response['header'] = $header;
                $compare = view('WebSite.layouts.compare_list')->render();
                $response['compare_list'] = $compare;

            } catch (\Exception $e) {
                Log::error('Error rendering :', ['error' => $e->getMessage()]);
            }
        }
        return  response()->json($response);
    }
    public function compareDelete($request)
    {
        $id = $request->input('compare_id');
        $result = Cart::instance('compare')->remove($id);

        $response = [];

        $response['status'] = true;
        $response['message'] = "Item has been moved to a compare ";

        try {
            $header = view('WebSite.layouts.header')->render();
            $response['header'] = $header;
            $compare = view('WebSite.layouts.compare_list')->render();
            $response['compare_list'] = $compare;
        } catch (\Exception $e) {
            Log::error('Error rendering :', ['error' => $e->getMessage()]);
        }
        return response()->json($response);
    }
}
