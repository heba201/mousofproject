<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NameoriginRequest extends FormRequest
{
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
            'name_origin' => 'required|string|max:100',
        ];
    }

    public function messages(){

        return [
            'name_origin.required'  => 'هذا الحقل مطلوب ',
            'max'  => 'هذا الحقل طويل',
            'name_origin.string'  =>'الاسم لابد ان يكون حروف فقط ',
        ];
    }
}
