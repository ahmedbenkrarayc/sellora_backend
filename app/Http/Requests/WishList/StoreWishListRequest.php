<?php

namespace App\Http\Requests\WishList;

use Illuminate\Foundation\Http\FormRequest;

class StoreWishListRequest extends FormRequest
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
            'customer_id' => ['required', 'exists:customer,id'],
            'productvariant_id' => ['required', 'exists:productvariant,id'],
        ];
    }
}
