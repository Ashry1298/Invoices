<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'invoice_number' => 'required|string',
            'invoice_date' => 'required|date_format:Y-m-d',
            'due_date' => 'required|date_format:Y-m-d',
            'section_id' => 'required|numeric|regex:/^[0->9]*$/',
            'product' => 'required|string',
            'amount_collection' => 'required|numeric',
            'amount_commission' => 'required|numeric',
            'discount' => 'required|numeric',
            'rate_vat' => 'required|regex:/^[0->9]*%$/',
            'value_vate' => 'required|numeric',
            'total' => 'required|numeric',
            'status' => 'required|regex:/^[0->9]$/',
            'note' => 'nullable|string|max:900',
        ];
    }
}
