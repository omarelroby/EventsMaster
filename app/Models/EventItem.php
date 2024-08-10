<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventItem extends Model
{
     use HasFactory;
      protected $table = 'event_items';
    public $timestamps = true;


    protected $dates = ['deleted_at'];
    protected $fillable = array('title', 'content_summary','content_copy_file','auther_id','review','acceptability','number_of_copies','ISBN_number','price','organization_discount','organization_id','event_id');
}
