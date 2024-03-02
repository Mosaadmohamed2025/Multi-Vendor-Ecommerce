<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InterFaces\Shipping\ShippingRepositoryInterface;


class ShippingController extends Controller
{
    private $Shippings;

    public function __construct(ShippingRepositoryInterface $Shippings)
    {
        $this->Shippings = $Shippings;
    }

    public function index()
    {
        return $this->Shippings->index();   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Shippings->create();   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request , [
            'shipping_address' => 'string|required',
            'delivery_time' => 'string|required',
            'delivery_charge' => 'required|numeric',
            'status' => 'nullable|in:active,inactive'
        ]);

        return $this->Shippings->store($request);
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

        return $this->Shippings->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request , [
            'shipping_address' => 'string|required',
            'delivery_time' => 'string|required',
            'delivery_charge' => 'required|numeric',
            'status' => 'nullable|in:active,inactive'
        ]);
        return $this->Shippings->update($request);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request , string $id)
    {
        return $this->Shippings->destroy($request);
    }
}
