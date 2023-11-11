<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'section_name' => 'required|max:255|unique:sections,section_name,' . $this->id,
            'description' => 'max:255',
        ];
    }

    public function messages()
    {
        return [
            'section_name.required' => 'يرجى إدخال اسم القسم',
            'section_name.unique' => 'اسم القسم مسجل مسبقًا',
        ];
    }
}
