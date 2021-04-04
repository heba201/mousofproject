<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WordRequest extends FormRequest
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
            'word' => 'required|string',
            'word_type'  =>'required',
            'word_gzer'  =>'required|string',
            'gzer_type'  =>'required|string',
           'gzer_weight' =>'required|string',
           'word_source'  =>'required|string',
           'word_indication'  =>'required|string'
        ];
    }

    public function messages(){

        return [
            'word.required'  => 'هذا الحقل مطلوب ',
            'string'  =>'الاسم لابد ان يكون حروف فقط ',
            'word_type.required' => 'من فضلك حدد نوع الكلمة',
            'word_gzer.required'  => 'هذا الحقل مطلوب ',
            'gzer_type.required'  => 'هذا الحقل مطلوب ',
            'gzer_weight.required'  => 'هذا الحقل مطلوب ',
            'word_source.required'  =>'هذا الحقل مطلوب ',
            'word_indication.required'  =>'هذا الحقل مطلوب '
        ];
    }
}
