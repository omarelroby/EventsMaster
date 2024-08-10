<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipper extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'shippers';
    protected $fillable = [
        'account_number',
        'shipper_name',
        'name_commercial',
        'abbreviation',
        'id_registry_commercial',
        'file_register_commercial',
        'registry_id_tax',
        'email',
        'zip',
        'phone1',
        'phone2',
    ];

    protected $dates = ['deleted_at'];

}
