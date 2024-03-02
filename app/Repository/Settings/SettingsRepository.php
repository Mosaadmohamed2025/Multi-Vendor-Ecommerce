<?php

namespace App\Repository\Settings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\InterFaces\Settings\SettingsRepositoryInterface;
use App\Models\Settings;


class SettingsRepository implements SettingsRepositoryInterface
{
    public function index()
    {
        $settings = Settings::first();
        return view('Backend.Settings.index', compact('settings'));
    }

    public function update($request)
    {
        $settings = Settings::first();

        $status = $settings->update([
            'title'=>$request->title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
//            'favicon'=> $request->favicon,
//            'logo' => $request->logo,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'footer' => $request->footer,
            'facebook_url' => $request->facebook_url,
            'twitter_url' => $request->twitter_url,
            'linkedin_url' => $request->linkedin_url,
            'pinterest_url' => $request->pinterest_url,
        ]);

        if($request->has('logo')){
                $image = $request->file('logo');
                $imageName = $request->title.'-image-'.time().rand(1,1000).'.'.$image->extension();
                $image->move(public_path('logo_image'),$imageName);
                $settings->update([
                    'logo' => $imageName,
                ]);
        }
        if($request->has('favicon')){
            $image = $request->file('favicon');
            $imageName = $request->title.'-image-'.time().rand(1,1000).'.'.$image->extension();
            $image->move(public_path('favicon_image'),$imageName);
            $settings->update([
                'favicon' => $imageName,
            ]);
        }
        if($status)
        {
            return back()->with('success' , 'Settings successfully Updated');
        }else{
            return back()->with('error' , 'Something Went Wrong');
        }
    }
    public function smtp()
    {
        return view('Backend.Settings.smtp');
    }
    public function smtpUpdate($request)
    {
        foreach ($request->types as $key => $type) {
            $this->overWriteEnvFile($type , $request[$type]);
        }

        return back()->with('success' , 'SMTP configrations updates successfully ');
    }

    public function overWriteEnvFile($type ,$val)
    {
        $path = base_path('.env');
        if(file_exists($path))
        {
         $val='"'.trim($val).'"';
         if(is_numeric(strpos(file_get_contents($path),$type)) && strpos(file_get_contents($path),$type) >= 0)
         {
             file_put_contents($path,str_replace(
                 $type.'="'.env($type).'"' , $type.'='.$val,file_get_contents($path)
                 ));
         }
        }else{
            file_put_contents($path , file_get_contents($path)."\r\n".$type.'='.$val);
        }
    }
}
