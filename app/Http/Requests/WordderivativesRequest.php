<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WordderivativesRequest extends FormRequest
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
            'derivatives_meaning' => 'required|array|min:1',
            'derivatives_meaning.*' =>'required|string|distinct',
            'word_count' => 'required|exists:word_count,id',
        ];
    }

    public function messages(){
        return [

            'string'  =>'الاسم لابد ان يكون حروف فقط ',
           'word_derivatives.*.required' => 'هذا الحقل مطلوب ',
           'word_derivatives.*.distinct' => 'ادخل بيانات مختلفة',
           'derivatives_meaning.*.required' => 'هذا الحقل مطلوب ',
           'derivatives_meaning.*.distinct' => 'ادخل بيانات مختلفة',
           'word_count.exists'  => 'العدد غير موجود ',

        ];

    }
}
