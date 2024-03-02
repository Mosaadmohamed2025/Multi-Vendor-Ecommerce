<?php 

namespace App\InterFaces\Frontend;


use Illuminate\Database\Eloquent\Model;


interface WishlistRepositoryInterface{
    public function wishlist();
    public function wishlistStore($request);
    public function moveToCart($request);
    public function wishlistDelete($request);
}