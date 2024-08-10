<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationPerson extends Model
{
    use HasFactory;
     public $timestamps = true;
     protected $table = 'organization_persons';


    protected $dates = ['deleted_at'];
    protected $fillable = array('person_id','event_id','list_type_id','organization_id','account_number','reranking','role','authorized','authorized_file');
}
