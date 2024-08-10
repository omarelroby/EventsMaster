<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrgClasification extends Model
{
    use HasFactory;
    protected $table='org_clasifications';
    protected $fillable = array('classification_code', 'classification_abv','classification_sn','classification_spc');

}
