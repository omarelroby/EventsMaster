<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationLegalFormResource extends JsonResource
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
            "legal_form_sn"=> $this->legal_form_sn,
            "legal_form_spc"=>$this->legal_form_spc,
            "legal_form_abv"=>$this->legal_form_abv ?? '',
            "legal_form_code"=>$this->legal_form_code ?? '',
            'date' => $this->created_at
        ];
    }
}
