<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'invoice_number',
        'date_Invoice',
        'organization_id',
        'event_id',
        'list_type_id',
    ];

    // Relationships
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
