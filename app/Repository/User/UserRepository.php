<?php

namespace App\Repository\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\InterFaces\User\UserRepositoryInterface;
use App\Models\User;


class UserRepository implements UserRepositoryInterface{

    public function index()
    {
        $users = User::orderBy('id','DESC')->get();
        return view('Backend.user.index' , compact('users'));
    }

    public function create()
    {
        return view('Backend.user.add');
    }
    public function store($request){
        DB::beginTransaction();
        try{

            $User = new User();

            $User->full_name = $request->full_name;
            $User->username = $request->username;
            $User->email  = $request->email;
            $User->password  = Hash::make($request->password);
            $User->phone = $request->phone;
            $User->address = $request->address;

            if($request->status)
            {
                $User->status = $request->status;
            }
            if($request->role)
            {
                $User->role = $request->role;
            }

            if($request->has('image')){
                $image = $request->file('image');
                $imageName = $request->full_name.'-image-'.time().rand(1,1000).'.'.$image->extension();
                $image->move(public_path('user_images'),$imageName);
                $User->photo = $imageName;
            }

            $User->save();

            DB::commit();
            session()->flash('Add', 'The User has been added successfully');
            return redirect()->route('Users.index');

        }catch(\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('Backend.user.edit',compact('user'));
    }


    public function update($request)
    {
        $User = User::find($request->id);


        $User->full_name = $request->full_name;
        $User->username = $request->username;
        $User->email  = $request->email;
        $User->password  = Hash::make($request->password);
        $User->phone = $request->phone;
        $User->address = $request->address;

        if($request->status)
        {
            $User->status = $request->status;
        }
        if($request->role)
        {
            $User->role = $request->role;
        }

        if($request->has('image')){
            if($User->photo)
            {
                Storage::disk('user')->delete($User->photo);
            }
            $image = $request->file('image');
            $imageName = $request->full_name.'-image-'.time().rand(1,1000).'.'.$image->extension();
            $image->move(public_path('user_images'),$imageName);
            $User->photo = $imageName;
        }

        $User->save();

        session()->flash('edit', 'The User has been edtited successfully');
        return redirect()->route('Users.index');
    }

    public function destroy($request)
    {
        if($request->page_id==1){
            $UserID = $request->input('user_id');

            $User = User::find($UserID);

            if (!$User) {
                session()->flash('error', 'The User is not found');
                return redirect()->route('Users.index');
            }
            if($User->photo)
            {
                Storage::disk('user')->delete($User->photo);
            }

            $User->delete();

            session()->flash('delete', 'The User has been deleted');
            return redirect()->route('Users.index');

        }else{

            $delete_select_id = explode(",", $request->delete_select_id);
            foreach ($delete_select_id as $ids_Users) {
                $User = User::find($ids_Users);

                if ($User) {
                    if ($User->photo) {
                        Storage::disk('user')->delete($User->photo);
                    }

                    $User->delete();
                }
            }

            session()->flash('delete', 'The All Users have been deleted');
            return redirect()->route('Users.index');
        }
    }
}
