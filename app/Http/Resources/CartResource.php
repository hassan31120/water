<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use PhpParser\Node\Expr\Cast\Double;

class CartResource extends JsonResource
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
            'image' => asset($this->image),
            'amount' => $this->amount,
            'old_price' =>(double) $this->old_price,
            'new_price' =>(double) $this->new_price,
            'quantity' =>(integer) $this->quantity,
            'cart_id' =>(integer) $this->cart_id,
        ];
    }
}
