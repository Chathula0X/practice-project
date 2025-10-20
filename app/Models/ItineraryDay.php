<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ItineraryDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'itinerary_id',
        'day_number',
        'date',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function itinerary(){
        return $this->belongsTo(Itinerary::class);
    }

    public function items(){
        return $this->hasMany(ItineraryItem::class)->orderBy('sort_order');
    }

    public function totalCost(){
        return $this->items->sum('total_cost');
    }
}
