<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterestPerson extends Model
{
    use HasFactory;
   

    protected $table = 'interest_person';
    public $timestamps = true;
    protected $fillable = array('interest_id', 'person_id');


}
