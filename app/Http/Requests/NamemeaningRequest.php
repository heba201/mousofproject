<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NamemeaningRequest extends FormRequest
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
            'name'  =>'required|string',
            'nameorigin_id' => 'required|exists:names_origins,id',
            'name_type' => 'required',
            'name_meaning' =>'required|string',
        ];
    }
    public function messages(){

        return [
            'required'  => 'هذا الحقل مطلوب ',
            'name_type.required' => 'من فضلك اختر نوع الاسم',
            'string'  =>'الاسم لابد ان يكون حروف فقط ',
           'nameorigin_id.exists'  => 'أصل الاسم غير موجود ',

        ];
    }
}
