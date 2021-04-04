<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WisdomRequest extends FormRequest
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
            'wisdom' => 'required|string',
            'wisdom_type' => 'required',
            'wisdom_subject'  => 'required|exists:wisdom_sayingsubjects,id',
            'wisdom_photo' => 'required_without:id|image|mimes:jpeg,jpg,png,gif|max:5120',
            'character_id'=> 'required|exists:characters,id',
            'wisdom_tag' =>'required|array|min:1',
            'wisdom_tag.*' =>'required|string|distinct',

        ];
    }

    public function messages(){

        return [
            'required'  => 'هذا الحقل مطلوب ',
            'wisdom_type.required'  =>'من فضلك اختر حكمة أم مثل' ,
            'wisdom_subject.exists'  => 'الموضوع غير موجود ',
            'wisdom_photo.mimes'  => 'ملف الصورة يجب ان يكون من امتداد JPG,JPG,PNG,gif',
            'wisdom_photo.mimes.image'  => 'هذا الحقل ملف صورة',
            'wisdom_photo.max'  => 'حجم الصورة يجب الا يتعدي 5MB',
            'character_id.exists'  => 'القائل غير موجود ',
            'wisdom_tag.*.required' => 'هذا الحقل مطلوب ',
            'wisdom_tag.*.distinct' => 'ادخل بيانات مختلفة',
        ];
    }
}
