<?php

namespace App\Repository\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\InterFaces\Shipping\ShippingRepositoryInterface;
use App\Models\Shipping;


class ShippingRepository implements ShippingRepositoryInterface
{
    public function index()
    {
        $shippings = Shipping::orderBy('id','DESC')->get();
        return view('Backend.shipping.index' , compact('shippings'));
    }
    public function create()
    {
        return view('Backend.shipping.add');
    }
    public function store($request)
    {

        $status = Shipping::create(
            [
                'shipping_address' => $request->shipping_address,
                'delivery_time' => $request->delivery_time,
                'delivery_charge' => $request->delivery_charge,
                'status' => $request->status,
            ]
        );

        if($status)
        {
            session()->flash('Add', 'The shipping has been added successfully');
            return redirect()->route('Shippings.index');
        }else{
            return back()->with('error' , 'Something went wrong');
        }
    }
    public function edit($id)
    {
        $shipping= Shipping::findorfail($id);
        return view('Backend.shipping.edit', compact('shipping'));
    }
    public function update($request)
    {
        $shipping = Shipping::findorfail($request->id);


        if($shipping)
        {
            $data = $request->all();

            $status = $shipping->fill($data)->save();

            if($status)
            {
                session()->flash('Add', 'The shippings has been updated successfully');
                return redirect()->route('Shippings.index');
            }else{
                return back()->with('error' , 'Something went wrong');
            }
        }else{
            return back()->with('error' , 'shippings Not found ');

        }
    }
    public function destroy($request)
    {
        if($request->page_id==1){
            $ShippingID = $request->input('shipping_id');

            $Shipping = Shipping::find($ShippingID);

            if (!$Shipping) {
                session()->flash('error', 'The Shipping is not found');
                return redirect()->route('Shippings.index');
            }

            $Shipping->delete();

            session()->flash('delete', 'The Shipping has been deleted');
            return redirect()->route('Shippings.index');

        }else{

            $delete_select_id = explode(",", $request->delete_select_id);
            foreach ($delete_select_id as $ids_Shippings){
                $Shipping = Shipping::findorfail($ids_Shippings);
                $Shipping->delete();
            }

            session()->flash('delete', 'The All Shippings have been deleted');
            return redirect()->route('Shippings.index');
        }
    }
}
