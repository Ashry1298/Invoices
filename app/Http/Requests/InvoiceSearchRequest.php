<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceSearchRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules= [
            'radio' => 'required',
            'status' => 'required_if:radio,==,1|regex:/^[0->9]$/',
            'start_at' => 'required_with:status|date',
            'end_at' => 'required_with:status|date',
            'invoice_number' => 'required_if:radio,==,2|string',
        ];
        return $rules;
    }
}
