<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InterFaces\About\AboutRepositoryInterface;

class AboutController extends Controller
{
    private $About;

    public function __construct(AboutRepositoryInterface $About)
    {
        $this->About = $About;
    }

    public function index()
    {
        return $this->About->index();
    }

    public function update(Request $request)
    {
        return $this->About->update($request);
    }
}
