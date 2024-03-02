<?php

namespace App\Repository\Seller\Product;
use App\Models\Image;
use App\Models\ProductAttribute;
use App\Models\SizeGuide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\InterFaces\Seller\Product\ProductRepositoryInterface;
use App\Models\Product;


class ProductRepository implements ProductRepositoryInterface{
    public function index()
    {
        $products = Product::where(['addedBy' => 'Seller' , 'vendor_id' => auth()->user()->id])->orderBy('id','DESC')->get();
        return view('Seller.product.index' , compact('products'));
    }
    public function create()
    {
        return view('Seller.product.add');
    }
    public function store($request)
    {
        DB::beginTransaction();
        try{
            $product = new Product();

            $slug = Str::slug($request->title);
            $slug_count = Product::where('slug' , $slug)->count();
            if($slug_count > 0 ){
                $slug = time()."-".$slug;
            }

            $product->title = $request->title;
            $product->slug = $slug;
            $product->summary = $request->summary;
            $product->description = $request->description;

            if($request->stock)
            {
                $product->stock = $request->stock;
            }
            if($request->price)
            {
                $product->price = $request->price;
            }
            if($request->discount)
            {
                $product->discount = $request->discount;
            }
            if($request->status)
            {
                $product->status = $request->status;
            }
            if($request->conditions)
            {
                $product->conditions = $request->conditions;
            }
            $product->cat_id = $request->cat_id;
            $product->child_cat_id = $request->child_cat_id;
            $product->size = $request->size;
            $product->brand_id = $request->brand_id;
            $product->addedBy = 'Seller';
            $product->vendor_id = auth()->user()->id;
            $product->additional_info = $request->additional_info;
            $product->return_cancellation = $request->return_cancellation;
            $product->offer_price = $request->price - ($request->price * ($request->discount / 100));

            $product->save();

            if($request->has('images')){
                foreach($request->file('images')as $key => $image){
                    if ($key >= 3) {
                        break; // توقف إذا تجاوز عدد الصور الأقصى المسموح به (3)
                    }
                    $imageName = $request->title.'-image-'.time().rand(1,1000).'.'.$image->extension();
                    $image->move(public_path('product_images'),$imageName);
                    Image::create([
                        'product_id'=>$product->id,
                        'image'=>$imageName
                    ]);
                }
            }
            if($request->has('size_guides')){
                foreach($request->file('size_guides')as $key => $image){
                    if ($key >= 3) {
                        break; // توقف إذا تجاوز عدد الصور الأقصى المسموح به (3)
                    }
                    $imageName = $request->title.'-size_guide'.'-image-'.time().rand(1,1000).'.'.$image->extension();
                    $image->move(public_path('product_images'),$imageName);
                    SizeGuide::create([
                        'product_id'=>$product->id,
                        'image'=>$imageName
                    ]);
                }
            }


            DB::commit();
            session()->flash('Add', 'The Product has been added successfully');
            return redirect()->route('SellersProducts.index');

        }catch(\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        $product = Product::find($id);
        return view('Seller.product.edit',compact('product'));
    }
    public function show($id)
    {
        $product = Product::find($id);
        $product_attributes = ProductAttribute::where('product_id', $id)->get();
        return view('Seller.product.product-attribute' , compact('product','product_attributes'));
    }
    public function addProductAttribute($request , $id)
    {
        $data = $request->all();

        foreach ($data['original_price'] as $key => $val)
        {
            if(!empty($val))
            {
                $attribute = new ProductAttribute();
                $attribute['original_price'] = $val;
                $attribute['offer_price'] = $data['offer_price'][$key];
                $attribute['stock'] = $data['stock'][$key];
                $attribute['product_id'] = $id;
                $attribute['size'] = $data['size'][$key];
                $attribute->save();
            }
        }

        return redirect()->back()->with('success', 'Product attribute successfully added');
    }

    public function deleteProductAttribute( $id)
    {

        $product = ProductAttribute::find($id);

        if($product)
        {
        $product->delete();
        return redirect()->back()->with('delete', 'The product attribute has been deleted');

        }else{
            return redirect()->back()->with('error', 'The product attribute not found');
        }
    }
    public function update($request)
    {
        $product = Product::find($request->id);

        $slug = Str::slug($request->title);
        $slug_count = Product::where('slug' , $slug)->count();
        if($slug_count > 0 ){
             $slug = time()."-".$slug;
        }

        $product->title = $request->title;
        $product->slug = $slug;
        $product->summary = $request->summary;
        $product->description = $request->description;

        if($request->stock)
        {
                $product->stock = $request->stock;
        }
        if($request->price)
        {
            $product->price = $request->price;
        }
        if($request->discount)
        {
            $product->discount = $request->discount;
        }
        if($request->status)
        {
            $product->status = $request->status;
        }
        if($request->conditions)
        {
            $product->conditions = $request->conditions;
        }
        $product->cat_id = $request->cat_id;
        $product->child_cat_id = $request->child_cat_id;
        $product->size = $request->size;
        $product->brand_id = $request->brand_id;
        $product->addedBy = 'Seller';
        $product->vendor_id = auth()->user()->id;
        $product->additional_info = $request->additional_info;
        $product->return_cancellation = $request->return_cancellation;
        $product->offer_price = $request->price - ($request->price * ($request->discount / 100));


        $product->save();

        if($request->has('images')){
            foreach ($product->images as $image) {

                Storage::disk('product')->delete($image->image);
                $image->delete();

            }
            foreach($request->file('images')as $key => $image){
                if ($key >= 3) {
                    break; // توقف إذا تجاوز عدد الصور الأقصى المسموح به (3)
                }
                $imageName = $request->title.'-image-'.time().rand(1,1000).'.'.$image->extension();
                $image->move(public_path('product_images'),$imageName);

                $Image = new Image();
                $Image->product_id = $product->id;
                $Image->image = $imageName;

                $Image->save();
            }
        }

        if($request->has('size_guides')){
            foreach ($product->Size_Guide_images as $image) {

                Storage::disk('product')->delete($image->image);
                $image->delete();

            }
            foreach($request->file('size_guides')as $key => $image){
                if ($key >= 3) {
                    break; // توقف إذا تجاوز عدد الصور الأقصى المسموح به (3)
                }
                $imageName = $request->title.'-size_guide'.'-image-'.time().rand(1,1000).'.'.$image->extension();
                $image->move(public_path('product_images'),$imageName);

                $Image = new SizeGuide();
                $Image->product_id = $product->id;
                $Image->image = $imageName;

                $Image->save();
            }
        }
        session()->flash('edit', 'The product has been edtited successfully');
        return redirect()->route('SellersProducts.index');
    }
    public function destroy($request)
    {
        if($request->page_id==1){
            $productID = $request->input('product_id');

            $product = Product::find($productID);

            if (!$product) {
                session()->flash('error', 'The product is not found');
                return redirect()->route('SellersProducts.index');
            }

            foreach ($product->images as $image) {

                Storage::disk('product')->delete($image->image);
                $image->delete();

            }

            foreach ($product->Size_Guide_images as $image) {

                Storage::disk('product')->delete($image->image);
                $image->delete();

            }

            $product->delete();

            session()->flash('delete', 'The product has been deleted');
            return redirect()->route('SellersProducts.index');

        }
        else
        {
            $delete_select_id = explode(",", $request->delete_select_id);
            foreach ($delete_select_id as $ids_SellerProducts){
                $product = Product::findorfail($ids_SellerProducts);
                if($product->images){
                    foreach ($product->images as $image) {

                        Storage::disk('product')->delete($image->image);
                        $image->delete();

                    }

                }
                if($product->Size_Guide_images)
                {
                    foreach ($product->Size_Guide_images as $image){
                        Storage::disk('product')->delete($image->image);
                        $image->delete();
                    }

                }
                $product->delete();
            }

            session()->flash('delete', 'The All SellerProducts have been deleted');
            return redirect()->route('SellersProducts.index');
        }
    }
}
