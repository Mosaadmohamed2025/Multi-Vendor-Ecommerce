<?php


namespace App\InterFaces\Seller\Product;
use Illuminate\Database\Eloquent\Model;


interface ProductRepositoryInterface{

    public function index();

    public function create();

    public function edit($id);

    public function show($id);

    public function addProductAttribute($request , $id);

    public function deleteProductAttribute($id);

    public function destroy($request);

    public function update($request);
}
