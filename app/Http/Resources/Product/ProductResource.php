<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
           return [
               "id"=>$this->id,
               "user_id"=>$this->seller_id,
               "user_Email"=>User::find($this->seller_id)->email,
               
               
               "name"=>$this->name,
               "description"=>$this->detail,
               "price"=>$this->price,
               "quantity"=>$this->quantity >0?$this->quantity :"Out Of Stock",
               "image"=>$this->image,

               
               "discount"=>$this->discount,
               "total_price"=>round( (1- ($this->discount/100))*$this->price,2)  ,
               "Rating"=> $this->reviews->count()>0?round( $this->reviews->sum("star")/$this->reviews->count()):"No Rating yet",
               "href" =>[

                   'reviews'=>url("api/products/$this->id/reviews")
               ]

           ];
    
    }
}
