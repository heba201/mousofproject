<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GazerweightRequest extends FormRequest
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
            'gazer_weight' => 'required|string|max:100',

        ];
    }

    public function messages(){

        return [
            'required'  => 'هذا الحقل مطلوب ',
            'max'  => 'هذا الحقل طويل',
            'gazer_weight.string'  =>'هذا الحقل لابد ان يكون حروف فقط '
        ];
    }
}
