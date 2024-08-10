<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory;
      protected $table = 'events';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('title', 'abbreviation','name_tag','zip','email','phone1','phone2','whatsapp','website','city_id','president','start_date','registration_start_date','registration_end_date','event_end_date','public_event_start_date','shipping_start_date','street_adress','map_location','event_specialty_id','event_series_id','discount','map_lat','map_lng');

}
