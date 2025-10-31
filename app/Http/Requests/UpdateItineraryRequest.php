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
            'inquiry_id' => 'nullable|exists:inquiries,id',
            'title' => 'nullable|string|max:255',
            'destination' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'accommodation' => 'nullable|array',
            'accommodation.*.day' => 'nullable|integer',
            'accommodation.*.hotel_name' => 'nullable|string|max:255',
            'accommodation.*.room_type' => 'nullable|string',
            'accommodation.*.cost' => 'nullable|numeric|min:0',
            'transport' => 'nullable|array',
            'transport.type' => 'nullable|string',
            'transport.from' => 'nullable|string',
            'transport.to' => 'nullable|string',
            'transport.cost' => 'nullable|numeric|min:0',
            'activities' => 'nullable|array',
            'activities.*.name' => 'nullable|string|max:255',
            'activities.*.cost' => 'nullable|numeric|min:0',
            'total_cost' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'status' => 'nullable|in:draft,pending,approved,rejected',
        ];
    }
}
