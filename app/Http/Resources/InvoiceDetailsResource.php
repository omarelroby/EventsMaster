<?php

namespace App\Http\Resources;

use App\Models\EventItem;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'invoice' => new InvoiceResource($this->organization),
            'event_item' => new EventItem($this->item),
        ];
    }
}
