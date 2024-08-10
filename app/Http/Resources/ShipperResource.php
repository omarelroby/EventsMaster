<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShipperResource extends JsonResource
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
            'account_number' => $this->account_number,
            'shipper_name' => $this->shipper_name,
            'name_commercial' => $this->name_commercial,
            'abbreviation' => $this->abbreviation,
            'id_registry_commercial' => $this->id_registry_commercial,
            "file_register_commercial"=>$this->file_register_commercial ? url($this->file_register_commercial) : '',

            'registry_id_tax' => $this->registry_id_tax,
            'email' => $this->email,
            'zip' => $this->zip,
            'phone1' => $this->phone1,
            'phone2' => $this->phone2,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
