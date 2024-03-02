<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InterFaces\Seller\Product\ProductRepositoryInterface;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    private $Products;

    public function __construct(ProductRepositoryInterface $Products)
    {
        $this->Products = $Products;
    }


    public function index()
    {
        return $this->Products->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Products->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        return $this->Products->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->Products->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->Products->edit($id);
    }

    public function addProductAttribute(Request $request , $id)
    {

        return $this->Products->addProductAttribute($request , $id);
    }

    public function deleteProductAttribute( $id)
    {
        return $this->Products->deleteProductAttribute( $id);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            "title" => 'string|required',
            "summary" => 'string|required',
            "description" => 'string|nullable',
            "stock" => 'nullable|numeric',
            "price" => 'nullable|numeric',
            "discount" => 'nullable|numeric',
            "image"=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            "status" => 'nullable|in:active,inactive',
            "cat_id" => 'required|exists:categories,id',
            "child_cat_id" => 'nullable|exists:categories,id',
            "size"=>'required',
            "conditions"=>'nullable',
        ]);
        return $this->Products->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Products->destroy($request);
    }
}
