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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'           => 'required|string|max:255',
            'image'          => 'nullable|image|max:2048',
            'purchase_price' => 'required|numeric|min:0',
            'sell_price'     => 'required|numeric|min:0',
            'discount_type'  => 'nullable|in:flat,%',
            'discount'       => 'nullable',
            'status'         => 'required|in:active,inactive',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'           => 'Product name is required.',
            'purchase_price.required' => 'Purchase price is required.',
            'sell_price.required'     => 'Sell price is required.',
            'status.required'         => 'Product status is required.',
        ];
    }
}
