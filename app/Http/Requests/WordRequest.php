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
            'word_gzer'  =>'required|exists:word_gazer,id',
            'gazer_type'  =>'required|exists:gazer_type,id',
           'gzer_weight' =>'required|exists:gazer_weight,id',
           'word_source'  =>'required|exists:source,id',
           'word_indication'  =>'required|exists:word_indication,id',
           'weight_indication'=>'required|exists:weight_indication,id',
           'time'=>'required|exists:time,id',
        ];
    }

    public function messages(){

        return [
            'word.required'  => 'هذا الحقل مطلوب ',
            'string'  =>'الاسم لابد ان يكون حروف فقط ',
            'word_type.required' => 'من فضلك حدد نوع الكلمة',
            'word_gzer.required'  => 'هذا الحقل مطلوب ',
            'word_gzer.exists'  => 'جذر الكلمة غير موجود',
            'gazer_type.required'  => 'هذا الحقل مطلوب ',
            'gazer_type.exists'  => ' نوع جذر الكلمة غير موجود ',
            'gzer_weight.required'  => 'هذا الحقل مطلوب ',
            'gzer_weight.exists'  => ' وزن الجذر  غير موجود ',
            'word_source.required'  =>'هذا الحقل مطلوب ',
            'word_source.exists'  =>'  مصدر الكلمة غير موجود ',
            'word_indication.required'  =>'هذا الحقل مطلوب ',
            'word_indication.exists'  =>'الدلالة غير موجودة ',
            'weight_indication.required'  =>'هذا الحقل مطلوب ',
            'weight_indication.exists'  =>' دلالةالوزن غير موجودة ',
            'time.required'  =>'هذا الحقل مطلوب ',
            'time.exists'  =>' الزمن غير موجود ',
        ];
    }
}
