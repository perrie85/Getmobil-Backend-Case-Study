<?php

namespace App\Http\Requests;

use App\Rules\ValidatePaymentInformationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => ['required', 'integer'],
            'payment' => ['required', 'array', new ValidatePaymentInformationRule],
            'address' => ['sometimes', 'string'],
            'quantity' => ['required', 'integer'],
        ];
    }
}
