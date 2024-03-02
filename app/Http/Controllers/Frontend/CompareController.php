<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InterFaces\Frontend\CompareRepositoryInterface;

class CompareController extends Controller
{
    private $compare;

    public function __construct(CompareRepositoryInterface $compare)
    {
        $this->compare = $compare;
    }

    public function compare()
    {
        return $this->compare->compare();
    }

    public function compareStore(Request $request)
    {
        return $this->compare->compareStore($request);
    }

    public function compareDelete(Request $request)
    {
        return $this->compare->compareDelete($request);
    }

    public function moveToCart(Request $request)
    {
        return $this->compare->moveToCart($request);
    }
}
