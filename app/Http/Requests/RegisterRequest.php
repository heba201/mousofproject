<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'email'  => 'required|email|unique:admins,email,'.$this -> id,
            'password'   => 'required_without:id',
            'passwordconfirm' =>'required_with:password|same:password'
        ];
    }
    public function messages(){

        return [
            'required'  => 'هذا الحقل مطلوب ',
            'max'  => 'هذا الحقل طويل',
            'email.email' => 'صيغة البريد الالكتروني غير صحيحه',
            'name.string'  =>'الاسم لابد ان يكون حروف او حروف وارقام ',
            'email.unique' => 'البريد الالكتروني مستخدم من قبل ',
            'passwordconfirm.same' => 'كلمة السر غير متطابقة',
            'password.required_without' =>'ادخل كلمة السر',
            'passwordconfirm.required_with' =>'ادخل  تأكيد كلمة السر',

        ];
    }
}
