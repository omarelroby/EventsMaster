<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
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
            "first_name"=> $this->first_name,
            "nationality"=>$this->country->nationality ?? '',
            'surName' => $this->surName, 
            'name_tag' => $this->name_tag,
            'card_id'  => $this->card_id,
            'id_type'=>  $this->id_type,
            'id_expiration' => $this->id_expiration,
            'Honor' => $this->Honor,
            'email' => $this->email, 
            'birthdate' => $this->birthdate,
            'gender'  => $this->gender,
            'zip'=>  $this->zip,

            'Phone1' => $this->Phone1, 
            'WhatsApp' => $this->WhatsApp,
            'street_address'  => $this->street_address,
            'linkedIn'=>  $this->linkedIn,
            'Phone1' => $this->Job_title, 
            'WhatsApp' => $this->city_id,
            'street_address'  => $this->country_id,
            'linkedIn'=>  $this->leader_Sn,
            'account_number'=>  $this->account_number



        ];
    }
}
