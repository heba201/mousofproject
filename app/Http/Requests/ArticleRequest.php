<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'article_category'  => 'required|exists:articlecategories,id',
            'article_title' => 'required|string',
            'article_photo' => 'required_without:id|image|mimes:jpeg,jpg,png,gif|max:5120',
            'article_details'  => 'required|string'
        ];
    }

    public function messages(){

        return [
            'required'  => 'هذا الحقل مطلوب ',
            'article_category.exists'  => 'التصنيف غير موجود ',
            'article_title.string'  =>' لابد ان يكون حروف فقط ',
            'article_photo.mimes'  => 'ملف الصورة يجب ان يكون من امتداد JPG,JPG,PNG,gif',
            'article_photo.image'  => 'هذا الحقل ملف صورة',
            'article_photo.max'  => 'حجم الصورة يجب الا يتعدي 5MB',
        ];
    }
}
