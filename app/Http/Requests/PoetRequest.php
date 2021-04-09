<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PoetRequest extends FormRequest
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
            'poet_name' => 'required|string',
            'poet_era' => 'required|string',
            'poet_cv' => 'required|string',
            'poet_works' => 'required|array|min:1',
            'poet_works.*' =>'required|string|distinct',
        ];
    }


    public function messages(){

        return [
            'required'  => 'هذا الحقل مطلوب ',
            'string'  =>'الاسم لابد ان يكون حروف فقط ',
            'poet_works.*.required' => 'هذا الحقل مطلوب ',
            'poet_works.*.distinct' => 'ادخل بيانات مختلفة',
        ];
    }
}
