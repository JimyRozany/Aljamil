<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "id" => $this->id,
            "company_id" => $this->company_id,
            "category_id" => $this->category_id,
            "name" => $this->name,
            "price" => $this->price,
            "image" => asset($this->image),
            "desciption" => $this->desciption,
        ];
    }
}
