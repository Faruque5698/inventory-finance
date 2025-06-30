<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
            'product_id'    => 'required|exists:products,id',
            'sale_date'     => 'required|date',
            'total_amount'  => 'required|numeric|min:0',
            'discount'      => 'nullable|numeric|min:0',
            'quantity'      => 'nullable|numeric|min:0',
            'vat'           => 'nullable|numeric|min:0',
            'net_amount'    => 'required|numeric|min:0',
            'paid_amount'   => 'required|numeric|min:0',
            'due_amount'    => 'required|numeric|min:0',
        ];
    }
}
