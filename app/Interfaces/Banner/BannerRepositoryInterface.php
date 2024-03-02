<?php

namespace App\InterFaces\Banner;


use Illuminate\Database\Eloquent\Model;

interface BannerRepositoryInterface{

    public function index();

    public function create();

    public function edit($id);
    
    public function store($request);

    public function destroy($request);

    public function update($request);

}