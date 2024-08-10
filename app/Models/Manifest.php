<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manifest extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'manifest';
    protected $fillable = [
        'manifest_number',
        'date_receiving_shipment',
        'quantity',
        'number_clearance_customs',
        'shipper_id',
        'truck_id',
        'driver_id',
        'organization_id',
        'event_id',
        'list_type_id',
    ];

    protected $dates = ['deleted_at', 'date_receiving_shipment'];

    // Relationships
    public function shipper()
    {
        return $this->belongsTo(Shipper::class, 'shipper_id');
    }

    public function truck()
    {
        return $this->belongsTo(Truck::class, 'truck_id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function listType()
    {
        return $this->belongsTo(ListedType::class, 'list_type_id');
    }
}
