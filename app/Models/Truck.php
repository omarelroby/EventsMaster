<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Truck extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'trucks';
    protected $fillable = [
        'no_plate',
        'shipper_id',
    ];

    protected $dates = ['deleted_at'];

    // Define the relationship with the Shipper model
    public function shipper()
    {
        return $this->belongsTo(Shipper::class, 'shipper_id');
    }
}
