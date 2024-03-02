<?php 

namespace App\InterFaces\Coupon;


use Illuminate\Database\Eloquent\Model;


interface CouponRepositoryInterface{
    public function index();
    public function create();
    public function edit($id);
    public function update($request);
    public function destroy($request);

}