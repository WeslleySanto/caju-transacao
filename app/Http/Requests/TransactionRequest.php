<?php

namespace App\Http\Requests;

use Illuminate\Http\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class TransactionRequest extends FormRequest
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
            'accountId' => 'required',
            'amount' => 'required',
            'mcc'       => 'required|min:4|max:4',
            'merchant' => 'required|max:255',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = new Response(['error' => $validator->errors()->first()], 422);
        throw new ValidationException($validator, $response);
    }
}
