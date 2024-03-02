<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InterFaces\Seller\Order\OrderRepositoryInterface;

class OrderController extends Controller
{
    private $Orders;

    public function __construct(OrderRepositoryInterface $Orders)
    {
        $this->Orders = $Orders;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->Orders->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->Orders->edit($id);
    }

    /**
     * Update  the order status.
     */
    public function orderStatus(Request $request , $id)
    {
        return $this->Orders->orderStatus($request , $id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Orders->destroy($request);
    }
}
