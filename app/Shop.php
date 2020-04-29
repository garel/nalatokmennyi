<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        "name",
        "slug"
    ];

    public function prices(){
        return $this->hasMany(Price::class);
    }
}
