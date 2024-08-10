<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrgLegalForm extends Model
{
    use HasFactory;
    protected $table='org_legal_forms';
    protected $fillable = array('legal_form_code', 'legal_form_abv','legal_form_sn','legal_form_spc');

}
