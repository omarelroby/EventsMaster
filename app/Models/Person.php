<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Person extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'persons';
    public $timestamps = true;


    protected $dates = ['deleted_at'];
    protected $fillable = array('first_name', 'second_name','surName','name_tag','card_id','id_type','id_expiration','Honor',
                              'email','birthdate','gender','zip','Phone1','WhatsApp','street_address','linkedIn','Job_title',
                            'city_id','country_id','leader_Sn','account_number');

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }
}
