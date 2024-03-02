<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['title' , 'slug'  , 'photo' , 'summary' ,'description' , 'additional_info' ,'return_cancellation' ,'size_guide', 'stock' ,'brand_id','cat_id','child_cat_id', 'price' , 'offer_price','discount','size','conditions','vendor_id','status'];


    public function images(){
        return $this->hasMany(Image::class);
    }

    public function Size_Guide_images(){
        return $this->hasMany(SizeGuide::class);
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');

    }

    public function related_products()
    {
        return $this->hasMany('App\Models\Product' , 'cat_id' , 'cat_id')->where('status' , 'active')->limit('10');
    }

    public static function getProductByCart($id)
    {
        return self::where('id' , $id)->get()->toArray();
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class , 'product_orders')->withPivot('quantity')->withTimestamps();
    }
    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }
}
