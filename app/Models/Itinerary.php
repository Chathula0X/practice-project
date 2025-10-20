<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Itinerary extends Model
{
    use HasFactory;

    protected $fillable = [
        'inquiry_id',
        'version',
        'notes',
        'title',
        'destination',
        'start_date',
        'end_date',
        'total_cost',
        'markup',
        'status',
    ];

    //inquiry relationship
    public function inquiry(){
        return $this->belongsTo(Inquiry::class);
    }
    
}
