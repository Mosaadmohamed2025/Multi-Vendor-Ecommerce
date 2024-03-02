<?php

namespace App\Repository\About;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\InterFaces\About\AboutRepositoryInterface;
use App\Models\AboutUs;


class AboutRepository implements AboutRepositoryInterface
{
    public function index()
    {
        $aboutus = AboutUs::first();
        return view('Backend.about.index', compact('aboutus'));
    }

    public function update($request)
    {
        $Aboutus = AboutUs::first();

        $status = $Aboutus->update([
            'heading' => $request->heading,
            'content' => $request->content,
            'experience' => $request->experience,
            'return_customer' => $request->return_customer,
            'happy_customer' => $request->happy_customer,
            'award_won' => $request->award_won,
            ]);

        if($request->has('image')){
            $image = $request->file('image');
            $imageName = $request->heading.'-image-'.time().rand(1,1000).'.'.$image->extension();
            $image->move(public_path('about_image'),$imageName);
            $Aboutus->update([
                'image' => $imageName,
            ]);
        }
        if($status)
        {
            return back()->with('success' , 'Settings successfully Updated');
        }else{
            return back()->with('error' , 'Something Went Wrong');
        }
    }
}
