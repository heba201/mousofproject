<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WordindicationRequest extends FormRequest
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
            'word_indication' => 'required|string|max:100',
        ];
    }

    public function messages(){

        return [
            'required'  => 'هذا الحقل مطلوب ',
            'max'  => 'هذا الحقل طويل',
            'word_indication.string'  =>'هذا الحقل لابد ان يكون حروف فقط '
        ];
    }
}
