<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationClassificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id"=> $this->id,
            "classification_sn"=> $this->classification_sn,
            "classification_spc"=>$this->classification_spc,
            "classification_code"=>$this->classification_code ?? '',
            'date' => $this->created_at
        ];
    }
}
