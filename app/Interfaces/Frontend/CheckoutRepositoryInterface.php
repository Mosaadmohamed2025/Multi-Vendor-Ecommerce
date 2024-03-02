<?php


namespace App\InterFaces\Frontend;


use Illuminate\Database\Eloquent\Model;


interface CheckoutRepositoryInterface{
    public function checkout1();

    public function checkout1Store($request);

    public function checkout2Store($request);

    public function checkout3Store($request);

    public function checkoutStore($request);

    public function completeStripe($order);

    public function completeCashOnDelivery($order);
}
