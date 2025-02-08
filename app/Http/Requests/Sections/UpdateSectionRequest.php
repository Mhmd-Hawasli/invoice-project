<?php

namespace App\Http\Requests\Sections;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'section_name' => 'nullable|string|max:255|unique:sections,section_name,' . $this->route('section')->id,
            'description'  => 'nullable|string|max:500',
        ];
    }

    /**
     * Get custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'section_name.required' => 'مطلوب إدخال اسم القسم.',
            'section_name.string'   => 'اسم القسم يجب أن يكون نصأ.',
            'section_name.unique'   => 'اسم القسم موجود مسبقاً.',
            'description.string'    => 'الوصف يجب أن يكون نصاً.'

        ];
    }
}
