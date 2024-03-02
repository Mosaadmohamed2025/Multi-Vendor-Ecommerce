<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InterFaces\Category\CategoryRepositoryInterface;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;


class CategoryController extends Controller
{
    private $Categories;

    public function __construct(CategoryRepositoryInterface $Categories)
    {
        $this->Categories = $Categories;
    }
    
    
    public function index()
    {
        return $this->Categories->index();
    }

    
    public function create()
    {
        return $this->Categories->create();
    }


    public function store(StoreCategoryRequest $request)
    {
        return $this->Categories->store($request);
    }

    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        return $this->Categories->edit($id);
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            "title" => 'string|required',
            "summary" => 'string|nullable',
            "image" => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            "status" => 'nullable|in:active,inactive',
            "is_parent" => 'sometimes|in:1',
            "parent_id" => 'nullable|numeric'
        ]);
        return $this->Categories->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->Categories->destroy($request);
    }
    public function getChildByParentID(Request $request , $id){
        return $this->Categories->getChildByParentID($request , $id);
    }
}
