<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'integer', ],
            'category' => ['required', 'string', 'max:255']
        ];
    }

    public function messages(): array
    {
        return [
            'description.required' => 'The description field is required.',
            'description.string' => 'THe description has to be a string.',
            'description.max' => 'The description has a limit of 255 characters.',
            'amount.numeric' => 'The amount has to be a number.'
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
            response()->json([
                'errors' => $validator->errors()
            ], 422)
        );
    }
}
