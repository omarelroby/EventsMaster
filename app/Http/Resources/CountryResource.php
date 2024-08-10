<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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
            "name"=> $this->name,
            "flag"=>$this->flag ? url($this->flag) : '',
            "code"=>$this->code ?? '',
            "nationality"=>$this->nationality ?? '',
            "initials"=>$this->initials ?? '',
            'date' => $this->created_at
        ];
    }
}
