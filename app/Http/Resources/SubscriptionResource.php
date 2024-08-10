<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
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
            "name"=> $this->name ?? '',
            "description"=> $this->description ?? '',
            "image"=> url($this->image),
            "price"=> $this->price ?? ' ',
            "months"=> $this->months ?? '',
            "start_date"=> $this->start_date ?? '',
            "end_date"=> $this->end_date ?? '',
            "package"=> new PackageResource($this->package) ?? '',
        ];
    }
}
