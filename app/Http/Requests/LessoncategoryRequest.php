<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessoncategoryRequest extends FormRequest
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
            'lesson_category' => 'required|string',
        ];
    }
    public function messages(){

        return [
            'required'  => 'هذا الحقل مطلوب ',
            'lesson_category.string'  =>'الاسم لابد ان يكون حروف فقط ',
        ];
    }
}
