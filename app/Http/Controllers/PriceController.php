<?php

namespace App\Http\Controllers;

use App\Price;
use App\Product;
use App\Shop;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function pricesByShop(Shop $shop){
        $prices = $shop->prices()
            ->with("product")
            ->orderBy("price","asc")
            ->get();

        return view("pages.prices")
            ->with(["prices" => $prices,"get" => "product"]);
    }

    public function pricesByProduct(Product $product){
        $prices = $product->prices()
            ->with("shop")
            ->orderBy("price","asc")
            ->get();

        return view("pages.prices")
            ->with(["prices" => $prices, "get" => "shop"]);
    }
}
