<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InterFaces\Brand\BrandRepositoryInterface;

class BrandController extends Controller
{
    private $Brands;

    public function __construct(BrandRepositoryInterface $Brands)
    {
        $this->Brands = $Brands;
    }
    
    public function index()
    {
        return $this->Brands->index();      
    }

    public function create()
    {
        return $this->Brands->create();      
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            "title" => 'required|string',
            "image" => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            "status" => 'nullable|in:active,inactive',
        ]);

        return $this->Brands->store($request);      
    }

    public function edit(string $id)
    {
        return $this->Brands->edit($id);    
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            "title" => 'required|string',
            "image" => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            "status" => 'nullable|in:active,inactive',
        ]);
        return $this->Brands->update($request);      
    }

    public function destroy(Request $request)
    {
        return $this->Brands->destroy($request);      
    }
}
