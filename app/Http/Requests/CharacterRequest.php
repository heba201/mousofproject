<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CharacterRequest extends FormRequest
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
            'character_name' => 'required|string',
            'about_character' => 'required|string',
            'character_type' => 'required',
            'character_photo' => 'required_without:id||image|mimes:jpeg,jpg,png,gif|max:5120',
        ];
    }

    public function messages(){

        return [
            'required'  => 'هذا الحقل مطلوب ',
            'string'  =>'الاسم لابد ان يكون حروف فقط ',
            'character_type.required'  => 'من فضلك اختر نوع الشخصية',
            'character_photo.mimes'  => 'ملف الصورة يجب ان يكون من امتداد jpeg,jpg,png,gif',
            'character_photo.image'  => 'هذا الحقل ملف صورة',
            'character_photo.max'  => 'حجم الصورة يجب الا يتعدي 5MB',
        ];
    }
}
