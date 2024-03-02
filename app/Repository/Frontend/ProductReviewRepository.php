<?php

namespace App\Repository\Frontend;
use App\Interfaces\Frontend\ProductReviewRepositoryInterface;
use App\Models\ProductReview;


class ProductReviewRepository implements ProductReviewRepositoryInterface{
    public function productReview($request)
    {
        $productReview = new ProductReview();

        $productReview->user_id = $request->user_id;
        $productReview->product_id = $request->product_id;
        $productReview->rate = $request->rating;
        $productReview->reason = $request->reason;
        $productReview->review = $request->review;

        $productReview->save();

        if ($productReview) {
            return response()->json(['message' => 'Review submitted successfully', 'status' => true]);
        } else {
            return response()->json(['message' => 'Failed to submit review', 'status' => false]);
        }
    }

}
