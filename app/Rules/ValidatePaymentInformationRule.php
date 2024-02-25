<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;

class ValidatePaymentInformationRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $validator = Validator::make($value, [
            'card_number' => ['required', 'string', 'size:16'],
            'cvc' => ['required', 'integer', 'max:999', 'min:100'],
            'full_name' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            $fail($validator->errors()->toArray());
        }
    }
}
