<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
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

        return[
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'images' => $this->when($this->image2, asset($this->image2)),
            'images' => [
                $this->when($this->image, asset($this->image)),
                $this->when($this->image2, asset($this->image2)),
                $this->when($this->image3, asset($this->image3)),
                $this->when($this->image4, asset($this->image4)),
                $this->when($this->image5, asset($this->image5))],
            'amount' => $this->amount,
            'old_price' =>(double) $this->old_price,
            'new_price' =>(double) $this->new_price,
            'sub_id' =>(int) $this->sub_id,
            'company' => $this->subcategories->categories->title
        ];
    }
}
