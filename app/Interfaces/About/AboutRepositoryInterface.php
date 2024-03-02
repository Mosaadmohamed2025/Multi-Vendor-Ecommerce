<?php


namespace App\InterFaces\About;
use Illuminate\Database\Eloquent\Model;


interface AboutRepositoryInterface{
    public function index();

    public function update($request);
}
