<?php

namespace App\InterFaces\Currency;


use Illuminate\Database\Eloquent\Model;


interface CurrencyRepositoryInterface{
    public function index();
    public function create();

    public function store($request);

    public function update($request);

    public function destroy($request);

    public function edit($id);

    public function currencyLoad($request);
}
