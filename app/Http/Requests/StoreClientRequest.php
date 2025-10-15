<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'nationality' => 'required|string',
            'preferences' => 'nullable|string',
        ];
    }   

    public function messages(): array{
        return [
            'name.required' => 'Client name is required',
            'email.required' => 'Client email is required',
            'phone.required' => 'Client phone is required',
            'nationality.required' => 'Client nationality is required',
        ];
    }
}
