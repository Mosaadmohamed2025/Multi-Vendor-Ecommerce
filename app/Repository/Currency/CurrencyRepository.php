<?php

namespace App\Repository\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\InterFaces\Currency\CurrencyRepositoryInterface;
use App\Models\Currency;

class CurrencyRepository implements CurrencyRepositoryInterface{
    public function index()
    {
        $currencies = Currency::orderBy('id', 'desc')->get();
        return view('Backend.currency.index',compact('currencies'));
    }
    public function create()
    {
        return view('Backend.currency.add');
    }

    public function store($request)
    {
        $data = $request->all();

        $status = Currency::create($data);

        if($status)
        {
            session()->flash('Add', 'The Currency has been added successfully');
            return redirect()->route('Currency.index');
        }else{
            return back()->with('error' , 'Something went wrong');
        }
    }
    public function edit($id)
    {
        $currency = Currency::findorfail($id);
        return view('Backend.currency.edit', compact('currency'));
    }
    public function update($request)
    {
        $currency = Currency::findorfail($request->id);

        if($currency)
        {
            $data = $request->all();

            $status = $currency->fill($data)->save();

            if($status)
            {
                session()->flash('Add', 'The currency has been updated successfully');
                return redirect()->route('Currency.index');
            }else{
                return back()->with('error' , 'Something went wrong');
            }
        }else{
            return back()->with('error' , 'Currency Not found ');
        }
    }
    public function destroy($request)
    {
        if($request->page_id==1){
            $currencyID = $request->input('currency_id');

            $currency = Currency::find($currencyID);

            if (!$currency) {
                session()->flash('error', 'The Coupon is not found');
                return redirect()->route('Currency.index');
            }

            $currency->delete();

            session()->flash('delete', 'The Currency has been deleted');
            return redirect()->route('Currency.index');

        }else{

            $delete_select_id = explode(",", $request->delete_select_id);
            foreach ($delete_select_id as $ids_currencies){
                $currency = Currency::findorfail($ids_currencies);
                $currency->delete();
            }

            session()->flash('delete', 'The All Currencies have been deleted');
            return redirect()->route('Currency.index');
        }
    }
    public function currencyLoad($request)
    {
        session()->put('currency_code' , $request->currency_code);

        $currency = Currency::where('code' , $request->currency_code)->first();

        session()->put('currency_symbol' , $currency->symbol);

        session()->put('currency_exchange_rate' , $currency->exchange_rate);

        $response['status'] = true;

        return $response;
    }
}
