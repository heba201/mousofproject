<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaedasubjectRequest extends FormRequest
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
            'faeda_subject' => 'required|string',

        ];
    }
    public function messages(){

        return [
            'required'  => 'هذا الحقل مطلوب ',
            'faeda_subject.string'  =>'الاسم لابد ان يكون حروف فقط ',
        ];
    }
}
