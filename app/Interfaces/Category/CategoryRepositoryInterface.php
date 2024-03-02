<?php 

namespace App\InterFaces\category;


use Illuminate\Database\Eloquent\Model;

interface CategoryRepositoryInterface{

    public function index();

    public function create();

    public function store($request);

    public function edit($id);

    public function update($request);

    public function destroy($request);

    public function getChildByParentID($request , $id);
}