<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
//            "data"=> $this->data,
            "title"=> $this->data['title'],
            "body"=> $this->data['body'],
            "created_at"=> $this->created_at ?? date('Y-m-d H:i:s'),
        ];
    }
}
