<?php

namespace App\Repository\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\InterFaces\Coupon\CouponRepositoryInterface;
use App\Models\Coupon;

class CouponRepository implements CouponRepositoryInterface{
    public function index()
    {
        $coupons = Coupon::orderBy('id', 'desc')->get();
        return view('Backend.coupons.index',compact('coupons'));
    }

    public function create()
    {
        return view('Backend.coupons.add');
    }

    public function store($request)
    {
        $data = $request->all();

        $status = Coupon::create($data);

        if($status)
        {
            session()->flash('Add', 'The coupon has been added successfully');
            return redirect()->route('Coupons.index');
        }else{
            return back()->with('error' , 'Something went wrong');
        }
    }
    public function edit($id)
    {
        $coupon = Coupon::findorfail($id);
        return view('Backend.coupons.edit', compact('coupon'));
    }
    public function update($request)
    {
        $coupon = Coupon::findorfail($request->id);

        if($coupon)
        {
            $data = $request->all();

            $status = $coupon->fill($data)->save();

            if($status)
            {
                session()->flash('Add', 'The coupon has been updated successfully');
                return redirect()->route('Coupons.index');
            }else{
                return back()->with('error' , 'Something went wrong');
            }
        }else{
            return back()->with('error' , 'Coupon Not found ');

        }
    }
    public function destroy($request)
    {
        if($request->page_id==1){
            $CouponID = $request->input('Coupon_id');

            $Coupon = Coupon::find($CouponID);

            if (!$Coupon) {
                session()->flash('error', 'The Coupon is not found');
                return redirect()->route('Coupons.index');
            }

            $Coupon->delete();

            session()->flash('delete', 'The Coupon has been deleted');
            return redirect()->route('Coupons.index');

        }else{

            $delete_select_id = explode(",", $request->delete_select_id);
            foreach ($delete_select_id as $ids_Coupons){
                $Coupon = Coupon::findorfail($ids_Coupons);
                $Coupon->delete();
            }

            session()->flash('delete', 'The All Coupons have been deleted');
            return redirect()->route('Coupons.index');
        }
    }
}
