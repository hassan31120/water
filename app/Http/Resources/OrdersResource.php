<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrdersResource extends JsonResource
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
            'total' => (double) $this->total,
            'status' => $this->status,
            'pay_status' => $this->pay_status,
            'grandTotal' => (double) $this->grandTotal,
            'created_at' => $this->created_at,
            'products' => DetailsResource::collection($this->orderDetails)
        ];

    }
}
