<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{

    protected $table = 'countries';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'flag', 'code','initials','nationality');

    public function cities()
    {
        return $this->hasMany('App\Models\City');
    }

}
