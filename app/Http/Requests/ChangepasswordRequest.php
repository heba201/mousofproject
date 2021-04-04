<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangepasswordRequest extends FormRequest
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
            'password'   => 'required',
            'passwordconfirm' =>'required_with:password|same:password'
        ];
    }

    public function messages(){

        return [
            'passwordconfirm.same' => 'كلمة السر غير متطابقة',
            'password.required' =>' ادخل كلمة السر الجديدة',
            'passwordconfirm.required_with' =>'ادخل  تأكيد كلمة السر',

        ];
    }
}
