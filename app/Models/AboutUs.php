<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;
    protected $fillable=['heading' , 'image' , 'experience' , 'return_customer' , 'happy_customer' , 'award_won' , 'content'];
}
