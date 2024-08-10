<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventOrganization extends Model
{
    use HasFactory;
     public $timestamps = true;


    protected $dates = ['deleted_at'];
    protected $fillable = array('organization_id','event_id','list_type_id','account_number','raranking','local_publishers_membership','publishing_license','issues_quantity','number_of_shipping','start_date','end_date','egent_id','revision','acceptability');
}
