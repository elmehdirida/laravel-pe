<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'price'=>$this->price,
            'description'=>$this->description,
            'category_id'=>$this->category_id,
            'discount_id'=>$this->discount_id,
            'rating'=>$this->rating,
            "image"=>$this->image,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'discount' => new DiscountResource($this->whenLoaded('discount')),
            'comment' => CommentResource::collection($this->whenLoaded('comments')),
            'stock'=>$this->stock,

        ];
    }
}