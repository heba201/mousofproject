<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MoradfatRequest extends FormRequest
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
            'moradf' => 'required|array|min:1',
            'moradf.*' =>'required|string|distinct',
        ];
    }

    public function messages(){

        return [
            'required'  => 'هذا الحقل مطلوب ',
            'string'  =>'الاسم لابد ان يكون حروف فقط ',
           'moradf.*.required' => 'هذا الحقل مطلوب ',
           'moradf.*.distinct' => 'ادخل بيانات مختلفة',
        ];
    }
}
