<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InterFaces\User\UserRepositoryInterface;
use App\Http\Requests\StoreUserRequest;


class UserController extends Controller
{
    private $Users;

    public function __construct(UserRepositoryInterface $Users)
    {
        $this->Users = $Users;
    }

    public function index()
    {
        return $this->Users->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Users->create();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        return $this->Users->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->Users->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'full_name' => 'string|required',
            'username' => 'string|nullable',
            'email' => 'email|required|exists:users,email',
            'password'=> 'min:4|nullable',
            'phone'=>'string|nullable',
            "image"=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address'=>'string|nullable',
            'role'=>'required|in:admin,customer,vendor',
            'status'=>'required|in:active,inactive',
        ]);
        return $this->Users->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Users->destroy($request);
    }
}
