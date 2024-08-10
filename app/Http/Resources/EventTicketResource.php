<?php

namespace App\Http\Resources;

use App\Http\Requests\EventRequest;
use App\Http\Resources\ProviderResource;
use Illuminate\Http\Resources\Json\JsonResource;

class EventTicketResource extends JsonResource
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
            'event'=>new InterestResource($this->event),
            'ticket'=>new TicketResource($this->ticket) ?? '',
            'donation_person'  => $this->donation_person,
              $this->mergeWhen($this->donation_person === 1, [
                    'name' => $this->name,
                    'phone' => $this->phone,
                     'email' => $this->email ,
                     'message'  => $this->message
        ]),
        ];
    }
}
