<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItineraryItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => 'required|in:transport,stay,activity,fees',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'details' => 'nullable|array',
            'quantity' => 'required|numeric|min:0.01',
            'unit_price' => 'required|numeric|min:0',
            'tax_fees' => 'nullable|numeric|min:0',
            'markup' => 'nullable|numeric|min:0',
        ];
    }
}


