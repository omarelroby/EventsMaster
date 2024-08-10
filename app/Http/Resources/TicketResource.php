<?php

namespace App\Http\Resources;

use App\Http\Resources\TicketCategoryResource;
use App\Http\Resources\ProviderResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->name,
            'price'=>$this->price,
            'available_seats'=>$this->available_seats,
            'category'=>new TicketCategoryResource($this->interest),
            
        ];
    }
}
