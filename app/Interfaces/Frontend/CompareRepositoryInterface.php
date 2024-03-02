<?php

namespace App\InterFaces\Frontend;


use Illuminate\Database\Eloquent\Model;


interface CompareRepositoryInterface{
    public function compare();
    public function compareStore($request);
    public function moveToCart($request);
    public function compareDelete($request);
}
