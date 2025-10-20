<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItineraryItem extends Model
{
    use HasFactory;

    protected $table = 'itinerary_items';

    protected $fillable = [
        'itinerary_day_id',
        'type',
        'title',
        'details',
        'quantity',
        'unit_price',
        'tax_fees',
        'markup',
        'total_price',
        'sort_order',
    ];

    protected $casts = [
        'details' => 'array',
        'quantity' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'tax_fees' => 'decimal:2',
        'markup' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    // Relationship
    public function itineraryDay()
    {
        return $this->belongsTo(ItineraryDay::class);
    }

    // Auto-calculation
    public function calculateTotalPrice()
    {
        $subtotal = $this->quantity * $this->unit_price;
        $total = $subtotal + $this->tax_fees + $this->markup;
        return round($total, 2);
    }

    // Type-specific accessors
    public function getTransportDetails()
    {
        return $this->type === 'transport' ? $this->details : null;
    }

    public function getStayDetails()
    {
        return $this->type === 'stay' ? $this->details : null;
    }

    public function getActivityDetails()
    {
        return $this->type === 'activity' ? $this->details : null;
    }

    public function getFeesDetails()
    {
        return $this->type === 'fees' ? $this->details : null;
    }
}
