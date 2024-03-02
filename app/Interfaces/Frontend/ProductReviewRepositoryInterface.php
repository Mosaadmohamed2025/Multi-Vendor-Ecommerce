<?php


namespace App\Interfaces\Frontend;

use Illuminate\Database\Eloquent\Model;

interface ProductReviewRepositoryInterface{
    public function productReview($request);
}
