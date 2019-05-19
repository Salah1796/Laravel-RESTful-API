<?php

namespace App\Http\Resources\Review;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id"=>$this->id,

            "user_id"=>$this->user_id,
            "Product_id"=>$this->product_id,
            
            "body"=>$this->review,
            "star"=>$this->star,


          ];
    }
}
