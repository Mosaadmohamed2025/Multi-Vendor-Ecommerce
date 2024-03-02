<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => 'string|required',
            'username' => 'string|nullable',
            'email' => 'email|required|unique:users,email',
            'password'=> 'min:4|required',
            'phone'=>'string|nullable',
            "image"=>'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address'=>'string|nullable',
            'role'=>'required|in:admin,customer,vendor',
            'status'=>'required|in:active,inactive',
        ];
    }
}
