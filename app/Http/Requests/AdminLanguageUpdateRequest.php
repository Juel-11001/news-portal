<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLanguageUpdateRequest extends FormRequest
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
        $langId=$this->route('language');
        return [
            'lang' => 'required|max:256|unique:languages,lang,'.$langId,
            'name' => 'required',
            'slug' => 'required|max:256|unique:languages,slug,'.$langId,
            'status' => 'required|boolean',
            'default' => 'required|boolean',
        ];
    }
}
