<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['title' , 'slug'  , 'photo' , 'is_parent' ,'summary' ,'parent_id'];

    public static function getChildByParentID($id){
        return Category::where('parent_id' , $id)->pluck('title' , 'id');
    }
    public function products()
    {
        return $this->hasMany('App\Models\Product', 'cat_id', 'id')->where('status', 'active');
    }
}
