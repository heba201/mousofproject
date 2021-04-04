<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaedaRequest extends FormRequest
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
    'faeda' => 'required|array|min:1',
    'faeda.*' =>'required|string|distinct',
    'faeda_subject_id'  => 'required|exists:faedasubjects,id',
        ];
    }

    public function messages(){

        return [
            'required'  => 'هذا الحقل مطلوب ',
            'string'  =>'الاسم لابد ان يكون حروف فقط ',
           'faeda.*.required' => 'هذا الحقل مطلوب ',
           'faeda.*.distinct' => 'ادخل بيانات مختلفة',
           'faeda_subject_id.exists'  => 'الموضوع غير موجود ',

        ];
    }
}
