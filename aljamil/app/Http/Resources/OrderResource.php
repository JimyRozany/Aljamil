<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            "order_id" => $this->id,
            "user_id" => $this->user_id,
            "name" => $this->name,
            "phone_1" => $this->phone_1,
            "phone_2" => $this->phone_2,
            "address" => $this->address,
            "city" => $this->city,
            "status" => $this->status,
            "created_at" => $this->created_at->format('Y-M-d h:i'),
            "updated_at" => $this->updated_at->format('Y-M-d h:i'),
        ];
    }
}
