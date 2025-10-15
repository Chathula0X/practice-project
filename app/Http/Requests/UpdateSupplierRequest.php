<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
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
            'type' => 'required|in:Hotel,Transport,Tour Company',
            'email' => 'required|email',
            'location' => 'required|string',
            'notes' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Supplier name is required',
            'type.required' => 'Supplier type is required',
            'type.in' => 'Supplier type must be Hotel, Transport, or Tour Company',
            'email.required' => 'Supplier email is required',
            'email.email' => 'Please enter a valid email address',
            'location.required' => 'Supplier location is required',
        ];
    }
}
