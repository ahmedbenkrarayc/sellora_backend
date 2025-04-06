<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'status' => ['in:pending,processing,completed,canceled'],
            'country' => ['required', 'string'],
            'city' => ['required', 'string'],
            'address' => ['required', 'string'],
            'postalcode' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'customer_id' => ['required', 'exists:customer,id'],
            'product_variants' => ['required', 'array'],
            'product_variants.*.id' => ['required', 'exists:productvariant,id'],
            'product_variants.*.quantity' => ['required', 'integer', 'min:1'],
        ];
    }
}
