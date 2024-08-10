<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'drivers';
    protected $fillable = [
        'name',
        'surname',
        'tag_name',
        'type_id',
        'date_birth',
        'phone1',
        'phone2',
        'photo',
        'shipper_id',
    ];

    // Define the relationship with the Shipper model
    public function shipper()
    {
        return $this->belongsTo(Shipper::class, 'shipper_id');
    }
}
