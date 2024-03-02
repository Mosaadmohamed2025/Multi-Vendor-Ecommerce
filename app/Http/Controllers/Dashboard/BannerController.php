<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BannerStoreRequest;
use App\InterFaces\Banner\BannerRepositoryInterface;

class BannerController extends Controller
{
    private $Banners;

    public function __construct(BannerRepositoryInterface $Banners)
    {
        $this->Banners = $Banners;
    }

    public function index()
    {
        return $this->Banners->index();
    }
    public function create()
    {
        return $this->Banners->create();
    }
    public function edit($id)
    {
        return $this->Banners->edit($id);
    }

    public function store(BannerStoreRequest $request)
    {
        return $this->Banners->store($request);
    }

    public function destroy(Request $request)
    {
        return $this->Banners->destroy($request);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            "title" => 'string|required',
            "description" => 'string|nullable',
            "image" => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            "condition" => 'required|in:banner,promo',
            "status" => 'required|in:active,inactive'
        ]);
        return $this->Banners->update($request);
    }
}
