<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInquiryRequest extends FormRequest
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
            'destination' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'budget' => 'required|numeric',
            'note' => 'nullable|string',
        ];
    }

    public function messages(): array{
        return [
            'destination.required' => 'Destination is required',
            'start_date.required' => 'Start date is required',
            'end_date.required' => 'End date is required',
            'budget.required' => 'Budget is required',
            'note.nullable' => 'Note is not required',
        ];
    }
}

