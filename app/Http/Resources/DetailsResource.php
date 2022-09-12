<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DetailsResource extends JsonResource
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
            'title' => $this->title,
            'image' => asset($this->image),
            'old_price' => $this->old_price,
            'new_price' => $this->new_price,
            'quantity' => $this->quantity,
            'order_id ' => $this->order_id
        ];
    }
}
