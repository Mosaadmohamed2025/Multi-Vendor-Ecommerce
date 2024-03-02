<?php

namespace App\Repository\Order;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\InterFaces\Order\OrderRepositoryInterface;


class OrderRepository implements OrderRepositoryInterface
{
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->get();
        return view('Backend.order.index', compact('orders'));
    }
    public function edit($id)
    {
        $order= Order::findorfail($id);
        return view('Backend.order.edit', compact('order'));
    }
    public function orderStatus($request , $id)
    {
        $order = Order::find($id);
        if($order)
        {
            if($request->input('condition') == 'delivered')
            {
                foreach($order->products as $item)
                {
                    $product = Product::where('id' , $item->pivot->product_id)->first();
                    $stock = $product->stock;
                    $stock -= $item->pivot->quantity;
                    $product->update(['stock'=> $stock]);
                    Order::where('id' , $id)->update(['payment_status' => 'paid']);
                }
            }
            $status= Order::where('id' , $id)->update(['condition' => $request->input('condition') ]);
            if($status)
            {
                return  back()->with('success' , 'Order Successfully Updated');
            }else{
                return back()->with('error' , 'Something Went Wrong');
            }
        }
    }
    public function destroy($request)
    {
        if($request->page_id==1){
            $OrderID = $request->input('order_id');

            $order = Order::find($OrderID);

            if (!$order) {
                session()->flash('error', 'The Order is not found');
                return redirect()->route('Orders.index');
            }

            $order->delete();

            session()->flash('delete', 'The Order has been deleted');
            return redirect()->route('Orders.index');

        }else{

            $delete_select_id = explode(",", $request->delete_select_id);
            foreach ($delete_select_id as $ids_Orders){
                $order = Order::findorfail($ids_Orders);
                $order->delete();
            }

            session()->flash('delete', 'The All Order have been deleted');
            return redirect()->route('Orders.index');
        }
    }
}
