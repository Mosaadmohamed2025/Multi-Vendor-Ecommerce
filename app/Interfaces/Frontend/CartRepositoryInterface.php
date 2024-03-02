<?php 

namespace App\InterFaces\Frontend;


use Illuminate\Database\Eloquent\Model;


interface CartRepositoryInterface{
    public function cartStore($request);
    public function cartDelete($request);
    public function cart();
    public function couponAdd($request);
}