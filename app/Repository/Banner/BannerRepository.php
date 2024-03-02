<?php

namespace App\Repository\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\InterFaces\Banner\BannerRepositoryInterface;
use App\Models\Banner;

class BannerRepository implements BannerRepositoryInterface{

    public function index()
    {
        $banners = Banner::orderBy('created_at', 'desc')->get();
        return view('Backend.banner.index' , compact('banners'));
    }

    public function create()
    {
        return view('Backend.banner.add');
    }

    public function store($request)
    {

        $slug = Str::slug($request->title);
        $slug_count = Banner::where('slug' , $slug)->count();

        if($slug_count > 0 ){
            $slug = time()."-".$slug;
        }

        if($request->has('image')){
            $image = $request->file('image');
            $imageName = $request->title.'-image-'.time().rand(1,1000).'.'.$image->extension();
            $image->move(public_path('banner_images'),$imageName);
            $banner = Banner::create([
                'title' =>$request->title,
                'slug' => $slug,
                'description' => $request->description,
                'photo' => $imageName,
                'status' => $request->status,
                'condition' => $request->condition,
            ]);
            $banner->save();
        }


        session()->flash('Add', 'The banner has been added successfully');
        return redirect()->route('Banners.index');
    }
    public function edit($id)
    {
        $banner = banner::findorfail($id);
        return view('Backend.banner.edit', compact('banner'));
    }
    public function update($request){

        $banner = banner::find($request->id);

        $slug = Str::slug($request->title);
        $slug_count = Banner::where('slug' , $slug)->count();

        if($slug_count > 0 ){
            $slug = time()."-".$slug;
        }

        $banner->title = $request->title;
        $banner->slug = $slug;
        $banner->description = $request->description;
        $banner->status = $request->status;
        $banner->condition = $request->condition;

        if($request->has('image')){

            Storage::disk('banner')->delete($banner->photo);
            $image = $request->file('image');
            $imageName = $request->title.'-image-'.time().rand(1,1000).'.'.$image->extension();
            $image->move(public_path('banner_images'),$imageName);
            $banner->photo = $imageName;
        }

        $banner->save();
        session()->flash('edit', 'The banner has been edtited successfully');
        return redirect()->route('Banners.index');
    }

    public function destroy($request)
    {
        if($request->page_id==1){
            $bannerID = $request->input('banner_id');

            $banner = Banner::find($bannerID);

            if (!$banner) {
                session()->flash('error', 'The banner is not found');
                return redirect()->route('Banners.index');
            }
            if($banner->photo)
            {
                Storage::disk('banner')->delete($banner->photo);
            }

            $banner->delete();

            session()->flash('delete', 'The banner has been deleted');
            return redirect()->route('Banners.index');

        }else{

            $delete_select_id = explode(",", $request->delete_select_id);
            foreach ($delete_select_id as $ids_banners){
                $banner = Banner::findorfail($ids_banners);
                Storage::disk('banner')->delete($banner->photo);
                $banner->delete();
            }

            session()->flash('delete', 'The All banners have been deleted');
            return redirect()->route('Banners.index');
        }
    }
}
