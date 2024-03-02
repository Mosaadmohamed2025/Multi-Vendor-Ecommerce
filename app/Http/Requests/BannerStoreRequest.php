<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerStoreRequest extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title" => 'string|required',
            "description" => 'string|nullable',
            "image" => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            "condition" => 'required|in:banner,promo',
            "status" => 'required|in:active,inactive'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => "the title is required",
            'description.required' => "the description is required",
        ];
    }
}