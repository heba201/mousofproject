<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SayingRequest extends FormRequest
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
    'saying' => 'required|array|min:1',
    'saying.*' =>'required|string|distinct',
    'saying_subject'  => 'required|exists:wisdom_sayingsubjects,id',
    'saying_photo' => 'required_without:id|image|mimes:jpeg,jpg,png,gif|max:5120',
    'saying_tag' => 'required|array|min:1',
    'saying_tag.*' =>'required|string|distinct',

        ];
    }

    public function messages(){

        return [
            'required'  => 'هذا الحقل مطلوب ',
            'string'  =>'الاسم لابد ان يكون حروف فقط ',
           'saying.*.required' => 'هذا الحقل مطلوب ',
           'saying.*.distinct' => 'ادخل بيانات مختلفة',
           'saying_subject.exists'  => 'الموضوع غير موجود ',
           'saying_photo.mimes'  => 'ملف الصورة يجب ان يكون من امتداد JPG,JPG,PNG,gif',
           'saying_photo.image'  => 'هذا الحقل ملف صورة',
           'saying_photo.max'  => 'حجم الصورة يجب الا يتعدي 5MB',
           'saying_tag.*.required' => 'هذا الحقل مطلوب ',
           'saying_tag.*.distinct' => 'ادخل بيانات مختلفة',
        ];
    }
}
