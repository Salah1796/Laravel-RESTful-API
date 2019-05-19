<?php

namespace App;
use App\Product;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    protected  $fillable= [
        "review","star","user_id"

    ];

    public  function  product()
    {
        return $this->belongsTo(Product::class);

    }
}
