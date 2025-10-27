<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItineraryRequest extends FormRequest
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
            'inquiry_id' => 'required|exists:inquiries,id',
            'title' => 'nullable|string|max:255',
            'destination' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'accommodations' => 'nullable|array',
            'accommodations.*.name' => 'required_with:accommodations|string|max:255',
            'accommodations.*.check_in' => 'nullable|date',
            'accommodations.*.check_out' => 'nullable|date',
            'transport_details' => 'nullable|array',
            'transport_details.*.type' => 'required_with:transport_details|string|max:50',
            'transport_details.*.details' => 'nullable|string',
            'activities' => 'nullable|array',
            'activities.*.name' => 'required_with:activities|string|max:255',
            'activities.*.date' => 'nullable|date',
            'estimated_budget' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ];
    }
}
