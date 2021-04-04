<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
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
            'lessoncategory_id'  => 'required|exists:lessoncategories,id',
            'lesson_title' => 'required|string',
            'lesson_photo' => 'required_without:id|image|mimes:jpeg,jpg,png,gif|max:5120',
            'lesson_details'  => 'required|string'
        ];
    }

    public function messages(){

        return [
            'required'  => 'هذا الحقل مطلوب ',
            'lessoncategory_i.exists'  => 'التصنيف غير موجود ',
            'lesson_title.string'  =>' لابد ان يكون حروف فقط ',
            'lesson_photo.mimes'  => 'ملف الصورة يجب ان يكون من امتداد JPG,JPG,PNG,gif',
            'lesson_photo.mimes.image'  => 'هذا الحقل ملف صورة',
            'lesson_photo.required_without'  => 'الصوره مطلوبة',
            'lesson_photo.max'  => 'حجم الصورة يجب الا يتعدي 5MB',

        ];
    }
}
