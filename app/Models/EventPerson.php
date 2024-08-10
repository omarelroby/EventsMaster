<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPerson extends Model
{
    use HasFactory;
     public $timestamps = true;
     protected $table = 'event_persons';


    protected $dates = ['deleted_at'];
    protected $fillable = array('person_id','event_id','list_type_id','account_number','role','vip','start_date','end_date','revision','acceptability');
}
