<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            "title" => 'string|required',
            "summary" => 'string|required',
            "description" => 'string|nullable',
            "stock" => 'nullable|numeric',
            "price" => 'nullable|numeric',
            "discount" => 'nullable|numeric',
            'images.*' => 'required|image|mimes:jpeg,png,jpg||max:2048', // السماح بصور JPEG و PNG بحجم أقصى 2MB لكل صورة
            'size_guides.*' => 'required|image|mimes:jpeg,png,jpg||max:2048', // السماح بصور JPEG و PNG بحجم أقصى 2MB لكل صورة
            "status" => 'nullable|in:active,inactive',
            "cat_id" => 'required|exists:categories,id',
            "child_cat_id" => 'nullable|exists:categories,id',
            "size"=>'required',
            "conditions"=>'nullable',
            "status" => 'nullable|in:active,inactive',
        ];
    }
}
