<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InterpreterResource extends JsonResource
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
            "image"=> $this->image? url($this->image): '',
            "note" =>$this->note,
            "experience_years" =>$this->experience_years ?? 1,
            "response_days" =>$this->response_days ?? 1,
        ];
    }
}
