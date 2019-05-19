<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\User;

class ProductCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            "id"=>$this->id,
            "user_id"=>$this->seller_id,
               "user_Email"=>User::find($this->seller_id)->email,
               
            "name"=>$this->name,
            "image"=>$this->image,
            "price"=>$this->price,

               "description"=>$this->detail,

            "discount"=>$this->discount,
            "total_price"=>round( (1- ($this->discount/100))*$this->price,2)  ,
            "Rating"=> $this->reviews->count()>0?round( $this->reviews->sum("star")/$this->reviews->count()):"No Rating yet",
            "href" =>[

                'Details'=>url("api/products/$this->id")
            ]

        ];

        // return parent::toArray($request);
    }
}
