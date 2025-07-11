<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfilePasswordUpdateRequest extends FormRequest
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
            'old_password'=>'required|min:8',
            'password'=>'required|min:8|confirmed',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if(!Hash::check($this->old_password, Auth::guard('admin')->user()->password)){
            //    throw ValidationException::withMessages([
            //        'old_password' => __('Old password does not match'),
            //    ]);
               $validator->errors()->add('old_password', __('Old password does not match'));
            }
        });
    }
}
