<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MojjamRequest extends FormRequest
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
            'author_id' => 'required|exists:mojjams_authors,id',
            'language_id' => 'required|exists:languages,id',
            'mojjamarrangetype_id' => 'exists:mojjam_arrangetypes,id',
            'mojjammethod_id' => 'required|exists:mojjam_methods,id',
        ];
    }
    public function messages(){

        return [
            'required'  => 'هذا الحقل مطلوب ',
            'max'  => 'هذا الحقل طويل',
            'name.string'  =>'الاسم لابد ان يكون حروف فقط ',
            'author_id.exists'  => 'المؤلف غير موجود ',
            'language_id.exists'  => 'اللغة غير موجودة ',
            'mojjamarrangetype_id.exists'  => 'نوع ترتيب المعجم  غير موجود ',
            'mojjammethod_id.exists'  => 'منهج المعجم غير موجود ',
        ];
    }
}
