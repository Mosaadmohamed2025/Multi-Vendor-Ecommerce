<?php

namespace App\Repository\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\InterFaces\Category\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface{

    public function index()
    {
        $categories = Category::orderBy('id','DESC')->get();
        return view('Backend.category.index' , compact('categories'));
    }
    public function create()
    {
        $parent_cats = Category::where('is_parent' , 1)->orderBy('title' , 'ASC')->get();
        return view('Backend.category.add' , compact('parent_cats'));
    }
    public function edit($id){
        $category = Category::findorfail($id);
        $parent_cats = Category::where('is_parent' , 1)->orderBy('title' , 'ASC')->get();
        return view('Backend.category.edit',compact('category','parent_cats'));
    }
    public function store($request){
        DB::beginTransaction();
        try{
            $category = new Category();

            $slug = Str::slug($request->title);
            $slug_count = Category::where('slug' , $slug)->count();
            if($slug_count > 0 ){
                $slug = time()."-".$slug;
            }

            $category->title = $request->title;
            $category->slug = $slug;
            $category->summary = $request->summary;

            $category->is_parent = boolval($request->input('is_parent', false));

            if($request->is_parent){
                $category->parent_id = null;
            }else{
                $category->parent_id = $request->parent_id;
            }

            if($request->status)
            {
                $category->status = $request->status;
            }
            if($request->has('image')){
                $image = $request->file('image');
                $imageName = $request->title.'-image-'.time().rand(1,1000).'.'.$image->extension();
                $image->move(public_path('category_images'),$imageName);
                $category->photo = $imageName;
            }
            $category->save();

            DB::commit();
            session()->flash('Add', 'The Category has been added successfully');
            return redirect()->route('Categories.index');

        }catch(\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update($request)
    {
        $category = Category::find($request->id);
        $slug = Str::slug($request->title);
        $slug_count = Category::where('slug' , $slug)->count();
        if($slug_count > 0 ){
            $slug = time()."-".$slug;
        }

        $category->title = $request->title;
        $category->slug = $slug;
        $category->summary = $request->summary;
        $category->is_parent = boolval($request->input('is_parent', false));

        if($request->is_parent){
            $category->parent_id = null;
        }else{
            $category->parent_id = $request->parent_id;
        }


        if($request->status)
        {
            $category->status = $request->status;
        }

        if($request->has('image')){
            Storage::disk('category')->delete($category->photo);
            $image = $request->file('image');
            $imageName = $request->title.'-image-'.time().rand(1,1000).'.'.$image->extension();
            $image->move(public_path('category_images'),$imageName);
            $category->photo = $imageName;
        }

        $category->save();
        session()->flash('edit', 'The category has been edtited successfully');
        return redirect()->route('Categories.index');
    }
    public function destroy($request)
    {
        if($request->page_id==1){
            $categoryID = $request->input('category_id');

            $category = Category::find($categoryID);

            if (!$category) {
                session()->flash('error', 'The category is not found');
                return redirect()->route('Categories.index');
            }
            if($category->photo)
            {
                Storage::disk('category')->delete($category->photo);
            }

            $category->delete();

            session()->flash('delete', 'The category has been deleted');
            return redirect()->route('Categories.index');

        }else{

            $delete_select_id = explode(",", $request->delete_select_id);
            foreach ($delete_select_id as $ids_categories) {
                $category = Category::find($ids_categories);

                if ($category) {
                    if ($category->photo) {
                        Storage::disk('category')->delete($category->photo);
                    }

                    $category->delete();
                }
            }

            session()->flash('delete', 'The All categories have been deleted');
            return redirect()->route('Categories.index');
        }
    }
    public function getChildByParentID($request, $id)
    {
        $category = Category::find($id);

        if ($category) {
            $child_id = Category::getChildByParentID($id);

            if ($child_id->isEmpty()) {
                return response()->json(['status' => false, 'data' => null, 'msg' => 'child < 0']);
            }

            return response()->json(['status' => true, 'data' => $child_id, 'msg' => '']);
        } else {
            return response()->json(['status' => false, 'data' => null, 'msg' => 'category not found']);
        }
    }
}
