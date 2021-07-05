<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModadRequest extends FormRequest
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
            'modad' => 'required|array|min:1',
            'modad.*' =>'required|string|distinct',
        ];
    }

    public function messages(){

        return [
            'required'  => 'هذا الحقل مطلوب ',
            'string'  =>'الاسم لابد ان يكون حروف فقط ',
           'modad.*.required' => 'هذا الحقل مطلوب ',
           'modad.*.distinct' => 'ادخل بيانات مختلفة',
        ];
    }
}
