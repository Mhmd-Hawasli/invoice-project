<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'product_name' => 'required|string|unique:products,product_name',
            'section_id'   => 'required|exists:sections,id',
            'description'  => 'nullable|string|max:500'
        ];
    }

    /**
     * Get custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'product_name.required' => 'مطلوب إدخال اسم المنتج.',
            'product_name.string'   => 'اسم المنتج يجب أن يكون نصأ.',
            'product_name.unique'   => 'اسم المنتج موجود مسبقاً.',
            'description.string'    => 'الوصف يجب أن يكون نصاً.'

        ];
    }
}
