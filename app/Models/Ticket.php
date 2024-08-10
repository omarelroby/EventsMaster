<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';
    public $timestamps = true;
    protected $fillable = array('name', 'phone','event_id');

    public function event()
    {
        return $this->belongsTo('App\Models\Event');
    }

  
}
