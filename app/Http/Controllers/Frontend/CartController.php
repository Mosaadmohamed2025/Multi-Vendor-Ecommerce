<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\InterFaces\Frontend\CartRepositoryInterface;

class CartController extends Controller
{
    private $Cart;

    public function __construct(CartRepositoryInterface $Cart)
    {
        $this->Cart = $Cart;
    }

    public function cartStore(Request $request)
    {
        return $this->Cart->cartStore($request);         
    }
    public function cartDelete(Request $request)
    {
        return $this->Cart->cartDelete($request);         
    }
    public function cart()
    {
        return $this->Cart->cart();
    }
    public function couponAdd(Request $request){
        return $this->Cart->couponAdd($request);
    }
}
