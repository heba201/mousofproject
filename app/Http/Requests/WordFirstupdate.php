<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WordFirstupdate extends FormRequest
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
            'word_derivatives' => 'required|array|min:1',
            'word_derivatives.*' =>'required|string|distinct',
            'word_meaning'=>'required',
           // 'word_meaning.*' =>'required|string|distinct',
        ];
    }

    public function messages(){

        return [
            'required'  => 'هذا الحقل مطلوب ',
            'string'  =>'الاسم لابد ان يكون حروف فقط ',
           'word_derivatives.*.required' => 'هذا الحقل مطلوب ',
           'word_derivatives.*.distinct' => 'ادخل بيانات مختلفة',
           'word_meaning.required' => 'هذا الحقل مطلوب ',
          // 'word_meaning.*.distinct' => 'ادخل بيانات مختلفة',
        ];
    }
}
