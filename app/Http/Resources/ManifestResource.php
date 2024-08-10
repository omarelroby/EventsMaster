<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ManifestResource extends JsonResource
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
            'manifest_number' => $this->manifest_number,
            'date_receiving_shipment' => $this->date_receiving_shipment, // Format the date
            'quantity' => $this->quantity,
            'number_clearance_customs' => $this->number_clearance_customs,
            'shipper' => new ShipperResource($this->shipper),
            'truck' => new TruckResource($this->truck),
            'driver' => new DriverResource($this->driver),
            'organization' => new OrganizationResource($this->organization),
            'event' => new EventResource($this->event),
            'list_type' => new ListTypeResource($this->listType),
        ];
    }
}
