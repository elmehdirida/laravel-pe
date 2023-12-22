<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order_date' => $this->order_date,
            'order_status' => $this->order_status,
            'total_amount' => $this->total_amount,
            'user_id' => $this->user_id,
            'order_products' => OrderProductResource::collection($this->whenLoaded('order_product')),
        ];
    }
}
