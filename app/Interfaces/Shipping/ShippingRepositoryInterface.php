<?php

namespace App\InterFaces\Shipping;
use Illuminate\Database\Eloquent\Model;


interface ShippingRepositoryInterface
{
    public function index();

    public function create();

    public function update($request);
}
