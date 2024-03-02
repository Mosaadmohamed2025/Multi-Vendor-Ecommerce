<?php


namespace App\InterFaces\User;
use Illuminate\Database\Eloquent\Model;


interface UserRepositoryInterface{

    public function index();

    public function create();
    
    public function store($request);

    public function edit($id);
    
    public function destroy($request);
    
    public function update($request);
}