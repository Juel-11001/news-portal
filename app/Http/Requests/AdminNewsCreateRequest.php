<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminNewsCreateRequest extends FormRequest
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
            'language'=>'required',
            'category'=>'required',
            'title'=>'required|max:256|unique:news,title',
            'content'=>'required',
            'meta_title'=>'max:256',
            'meta_description'=>'max:512',
            'is_breaking_news'=>'boolean',
            'show_at_slider'=>'boolean',
            'show_at_popular'=>'boolean',
            'status'=>'boolean',
            'image'=>'max:5048|mimes:jpg,jpeg,png,webp,svg,gif',
            'tags'=>'required'
        ];
    }
}
