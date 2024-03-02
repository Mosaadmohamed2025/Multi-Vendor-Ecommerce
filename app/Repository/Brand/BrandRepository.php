<?php

namespace App\Repository\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\InterFaces\Brand\BrandRepositoryInterface;
use App\Models\Brand;

class BrandRepository implements BrandRepositoryInterface{

    public function index()
    {
        $brands = Brand::orderBy('id','DESC')->get();
        return view('Backend.brand.index' , compact('brands'));
    }

    public function create()
    {
        return view('Backend.brand.add');
    }

    public function edit($id)
    {
        $brand = Brand::findorfail($id);
        return view('Backend.brand.edit' , compact('brand'));

    }
    public function store($request)
    {
        DB::beginTransaction();
        try{
            $brand = new Brand();

            $slug = Str::slug($request->title);
            $slug_count = Brand::where('slug' , $slug)->count();
            if($slug_count > 0 ){
                $slug = time()."-".$slug;
            }

            $brand->title = $request->title;
            $brand->slug = $slug;

            if($request->status)
            {
                $brand->status = $request->status;
            }
            if($request->has('image')){
                $image = $request->file('image');
                $imageName = $request->title.'-image-'.time().rand(1,1000).'.'.$image->extension();
                $image->move(public_path('brand_images'),$imageName);
                $brand->photo = $imageName;
            }
            $brand->save();

            DB::commit();
            session()->flash('Add', 'The brand has been added successfully');
            return redirect()->route('Brands.index');

        }catch(\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update($request)
    {
        $brand = Brand::find($request->id);

        $slug = Str::slug($request->title);
        $slug_count = Brand::where('slug' , $slug)->count();
        if($slug_count > 0 ){
            $slug = time()."-".$slug;
        }

        $brand->title = $request->title;
        $brand->slug = $slug;

        if($request->status)
        {
            $brand->status = $request->status;
        }

        if($request->has('image')){
            Storage::disk('brand')->delete($brand->photo);
            $image = $request->file('image');
            $imageName = $request->title.'-image-'.time().rand(1,1000).'.'.$image->extension();
            $image->move(public_path('brand_images'),$imageName);
            $brand->photo = $imageName;
        }

        $brand->save();
        session()->flash('edit', 'The brand has been edtited successfully');
        return redirect()->route('Brands.index');
    }
    public function destroy($request)
    {
        if($request->page_id==1){
            $brandID = $request->input('brand_id');

            $brand = Brand::find($brandID);

            if (!$brand) {
                session()->flash('error', 'The brand is not found');
                return redirect()->route('Brands.index');
            }
            if($brand->photo)
            {
                Storage::disk('brand')->delete($brand->photo);
            }

            $brand->delete();

            session()->flash('delete', 'The brand has been deleted');
            return redirect()->route('Brands.index');

        }else{

            $delete_select_id = explode(",", $request->delete_select_id);
            foreach ($delete_select_id as $ids_brands) {
                $brand = brand::find($ids_brands);

                if ($brand) {
                    if ($brand->photo) {
                        Storage::disk('brand')->delete($brand->photo);
                    }

                    $brand->delete();
                }
            }

            session()->flash('delete', 'The All brands have been deleted');
            return redirect()->route('Brands.index');
        }
    }
}
