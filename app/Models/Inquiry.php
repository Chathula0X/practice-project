<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'destination', 'start_date', 'end_date', 'budget', 'note'];

    //relationship with the client 
    public function client(){

        return $this->belongsTo(Client::class);
    }
}
