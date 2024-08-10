<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DriverResource extends JsonResource
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
            'name' => $this->name,
            'surname' => $this->surname,
            'tag_name' => $this->tag_name,
            'type_id' => $this->type_id,
            'date_birth' => $this->date_birth , // Format date if it's present
            'phone1' => $this->phone1,
            'phone2' => $this->phone2,
            "photo"=>$this->photo ? url($this->photo) : '',

            'shipper' => new ShipperResource($this->shipper),
        ];
    }
}
