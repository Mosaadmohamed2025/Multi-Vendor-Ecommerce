<?php


namespace App\InterFaces\Order;
use Illuminate\Database\Eloquent\Model;


interface OrderRepositoryInterface
{
public function index();

public function edit($id);

public function orderStatus($request , $id);

public function destroy($request);
}
