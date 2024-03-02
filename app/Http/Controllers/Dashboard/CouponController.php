<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InterFaces\Coupon\CouponRepositoryInterface;
use App\Http\Requests\CouponStoreRequest;

class CouponController extends Controller
{
    private $Coupons;

    public function __construct(CouponRepositoryInterface $Coupons)
    {
        $this->Coupons = $Coupons;
    }
    public function index()
    {
        return $this->Coupons->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Coupons->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponStoreRequest $request)
    {
        
        return $this->Coupons->store($request);
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
        return $this->Coupons->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CouponStoreRequest $request, string $id)
    {
        return $this->Coupons->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Coupons->destroy($request);
    }
}
