<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InterFaces\Frontend\WishlistRepositoryInterface;


class WishlistController extends Controller
{
    private $Wishlist;

    public function __construct(WishlistRepositoryInterface $Wishlist)
    {
        $this->Wishlist = $Wishlist;
    }

    public function wishlist()
    {
        return $this->Wishlist->wishlist();
    }
    public function wishlistStore(Request $request)
    {
        return $this->Wishlist->wishlistStore($request);
    }
    public function moveToCart(Request $request)
    {
        return $this->Wishlist->moveToCart($request);        
    }
    public function wishlistDelete(Request $request)
    {
        return $this->Wishlist->wishlistDelete($request);
    }
}
