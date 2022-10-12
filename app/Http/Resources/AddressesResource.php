<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressesResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'number' => $this->number,
            'title' => $this->title,
            'description' => $this->description,
            'governorate' => $this->governorate,
            'city' => $this->city,
            'lat' =>(double) $this->lat,
            'long' =>(double) $this->long,
            'shipping_price' =>(double) $this->cities->price
        ];
    }
}
