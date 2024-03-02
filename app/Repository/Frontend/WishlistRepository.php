<?php 

namespace App\Repository\Frontend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\InterFaces\Frontend\WishlistRepositoryInterface;
use Illuminate\Support\Facades\Log; 
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class WishlistRepository implements WishlistRepositoryInterface{
    public function wishlist()
    {
        return view('WebSite.wishlist.index');
    }
    public function wishlistStore($request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');
        $product = Product::getProductByCart($product_id);
        $price = $product[0]['offer_price'];

        $wishlist_array=[];

        foreach(Cart::instance('wishlist')->content() as $item)
        {
            $wishlist_array[] = $item->id;
        }

        if(in_array($product_id , $wishlist_array))
        {
            $response['present'] = true;
            $response['message'] = 'Item is already in your wishlist ';
        }else{
            $result = Cart::instance('wishlist')->add([
                'id' => $product_id,
                'name' => $product[0]['title'],
                'qty' => $product_qty,
                'price' => $price,
              ])->associate('App\Models\Product');
              if($result)
              {
                  $response['status'] = true;
                  $response['message'] = "Item Was added to your wishlist";
                  $response['wishlist_count'] = Cart::instance('wishlist')->count();
              
      
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
        $item = Cart::instance('wishlist')->get($request->input('rowId'));

        Cart::instance('wishlist')->remove($request->input('rowId'));
        $result  = Cart::instance('shopping')->add($item->id , $item->name , 1 , $item->price)->associate('App\Models\Product');
        
        if($result)
        {
            $response['status'] = true;
            $response['message'] = "Item has been moved to a cart ";
            try {
                $header = view('WebSite.layouts.header')->render();
                $response['header'] = $header;
                $wish_list = view('WebSite.layouts.wish_list')->render();
                $response['wish_list'] = $wish_list;

            } catch (\Exception $e) {
                Log::error('Error rendering :', ['error' => $e->getMessage()]);
            }        
        }
        return  response()->json($response);
    }
    public function wishlistDelete($request)
    {
        $id = $request->input('wishlist_id');
        $result = Cart::instance('wishlist')->remove($id);

        $response = []; 
     
            $response['status'] = true;
            $response['message'] = "Item has been moved to a wishlist ";
    
            try {
                $header = view('WebSite.layouts.header')->render();
                $response['header'] = $header;
                $wish_list = view('WebSite.layouts.wish_list')->render();
                $response['wish_list'] = $wish_list;
            } catch (\Exception $e) {
                Log::error('Error rendering :', ['error' => $e->getMessage()]);
            }        
        

        return response()->json($response);
    }
}
