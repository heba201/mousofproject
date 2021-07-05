<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class otherWordPropertiesRequest extends FormRequest
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
            'other_word_properties' => 'required|array|min:1',
            'other_word_properties.*' =>'required|string|distinct',
           // 'word_meaning' => 'required'
        ];
    }
    public function messages(){
        return [

            'string'  =>'الاسم لابد ان يكون حروف فقط ',
           'other_word_properties.*.required' => 'هذا الحقل مطلوب ',
           'other_word_properties.*.distinct' => 'ادخل بيانات مختلفة',
          // 'word_meaning.required' => 'هذا الحقل مطلوب '
        ];

    }
}
