<?php

namespace App;
use App\Review;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected  $fillable= [
            "name","price","detail","discount","quantity","image","seller_id"

        ];
    public  function  reviews()
    {
        return $this->hasMany(Review::class);

    }
}
