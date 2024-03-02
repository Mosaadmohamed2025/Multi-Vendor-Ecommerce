<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InterFaces\Currency\CurrencyRepositoryInterface;

class CurrencyController extends Controller
{
    private $Currencies;

    public function __construct(CurrencyRepositoryInterface $Currencies)
    {
        $this->Currencies = $Currencies;
    }

    public function currencyLoad(Request $request)
    {
        return $this->Currencies->currencyLoad($request);
    }
    public function index()
    {
        return $this->Currencies->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Currencies->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'string|required',
            'symbol' => 'string|required',
            'exchange_rate' => 'numeric|required',
            'code' => 'required',
            'status' => 'nullable|in:active,inactive',
        ]);
        return $this->Currencies->store($request);
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
        return $this->Currencies->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->Currencies->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Currencies->destroy($request);
    }
}
