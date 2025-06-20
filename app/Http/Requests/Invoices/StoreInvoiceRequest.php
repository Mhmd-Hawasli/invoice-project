<?php

namespace App\Http\Requests\Invoices;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
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
            'invoice-number'      => 'required|string|max:255|unique:invoices,invoice_number|regex:/^[A-Za-z0-9\-]+$/',
            'invoice-date'        => 'required|date',
            'due-date'            => 'required|date|after_or_equal:invoice_Date',

            'section'             => 'required|exists:sections,id',
            'product'             => 'required|exists:products,id',

            'collected-amount'    => 'required|numeric|min:0',
            'commission-amount'   => 'required|numeric|min:0',
            'discount'            => 'required|numeric|min:0',
            'rate-vat'            => 'required|numeric|min:0|max:100',
            'value-vat'           => 'required|numeric|min:0',
            'total'               => 'required|numeric|min:0',

            'note'                => 'nullable|string',
            'attachment'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // 2MB limit
        ];
    }
}
