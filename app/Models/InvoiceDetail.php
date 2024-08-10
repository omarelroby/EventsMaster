<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'quantity',
        'invoice_id',
        'item_id',
    ];

    // Relationships
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function item()
    {
        return $this->belongsTo(EventItem::class, 'item_id');
    }
}
