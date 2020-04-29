<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = [
        "shop_id",
        "product_id",
        "price"
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function shop(){
        return $this->belongsTo(Shop::class);
    }
}
