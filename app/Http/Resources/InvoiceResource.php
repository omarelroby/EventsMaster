<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
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
            'invoice_number' => $this->invoice_number,
            'date_Invoice' => $this->date_Invoice,
            'organization' => new OrganizationResource($this->organization),
            'event' => new EventResource($this->event),
            'list_type' => new ListTypeResource($this->listType),
        ];
    }
}
