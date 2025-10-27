<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Itinerary extends Model
{
    use HasFactory;

    protected $fillable = [
        'inquiry_id',
        'title',
        'destination',
        'start_date',
        'end_date',
        'accommodation',
        'transport',
        'activities',
        'accommodation_total',
        'transport_total',
        'activities_total',
        'total_cost',
        'notes',
        'timeline',
        'status',
    ];

    protected $casts = [
        'accommodation' => 'array',
        'transport' => 'array',
        'activities' => 'array',
        'timeline' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'accommodation_total' => 'decimal:2',
        'transport_total' => 'decimal:2',
        'activities_total' => 'decimal:2',
        'total_cost' => 'decimal:2',
    ];

    //relationship with the inquiry
    public function inquiry(){
        return $this->belongsTo(Inquiry::class);
    }

    // Helper method to calculate duration
    public function getDurationInDays()
    {
        return $this->start_date->diffInDays($this->end_date) + 1;
    }

    // Helper method to calculate totals
    public function calculateTotals()
    {
        // Accommodation
        if ($this->accommodation) {
            $nights = $this->accommodation['nights'] ?? 0;
            $costPerNight = $this->accommodation['cost_per_night'] ?? 0;
            $this->accommodation_total = $nights * $costPerNight;
        }

        // Transport
        if ($this->transport) {
            $this->transport_total = $this->transport['cost'] ?? 0;
        }

        // Activities
        $activitiesSum = 0;
        if ($this->activities && is_array($this->activities)) {
            foreach ($this->activities as $activity) {
                $activitiesSum += $activity['cost'] ?? 0;
            }
        }
        $this->activities_total = $activitiesSum;

        // Grand total
        $this->total_cost = $this->accommodation_total + $this->transport_total + $this->activities_total;
    }
}
