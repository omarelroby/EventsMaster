<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSpecialty extends Model
{
    use HasFactory;
    protected $table = 'event_specalities';
    
    protected $fillable = ['description','serial_number'];
}
