<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{

    protected $table = 'cities';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'country_id','initials','code');


    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }


}
