<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_name' => 'required|max:255',
            'description' => 'required|string',
            'section_id' => 'required|numeric'
        ];
    }
    public function messages(): array
    {
        return [
            'product_name.required' => ' يرجى ادخال اسم المنتج  ',
            'product_name.max' => 'الحد الاقصى لاسم المنتج لا يزيد عن 255 حرف',
            'description.required' => ' يرجى ادخال وصف المنتج  ',
            'section_id.required' => 'يرجى ادخال اسم القسم',

        ];
    }
}
