<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaytRequest extends FormRequest
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
            'poet_id' => 'required|exists:poets,id',
            'bayt' => 'required|array|min:1',
            'bayt.*' =>'required|string|distinct',
        ];
    }

    public function messages(){

        return [
            'required'  => 'هذا الحقل مطلوب ',
            'string'  =>'الاسم لابد ان يكون حروف فقط ',
           'bayt.*.required' => 'هذا الحقل مطلوب ',
           'bayt.*.distinct' => 'ادخل بيانات مختلفة',
           'poet_id.exists'  => 'الشاعر غير موجود ',

        ];
    }
}
