<?php

namespace App\Http\Controllers;

use App\Price;
use App\Product;
use App\Shop;
use DOMDocument;
use DOMXPath;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        return view("pages.list")
            ->with(
                [
                    "data" => Product::all(),
                    "get" => "product"
                ]
            );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {
        return view("pages.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $page = file_get_contents($request->slug);

        $doc = new DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML($page);
        $xpath = new DOMXPath($doc);

        $productName = $xpath->query("//h1[contains(@class,'visible-xs')]/text()");
        $productName = $doc->saveHTML($productName->item(0));

        $product = Product::firstOrCreate(
            ["name" => $productName],
            ["slug" => $request->slug]
        );

        $offers = $xpath->query("//div[contains(@class, 'optoffer')]");

        for($i=0;$i<$offers->length;$i++){
            $current = $offers->item($i);

            $shop = $xpath->query(".//a[@data-title]/@data-title",$current);
            if($shop->length>0){
                $price = $xpath->query(".//*[@itemprop='price']/text()",$current);
                $shopUrl = $xpath->query(".//a[@data-akptp]/@href",$current);
                $name = $doc->saveHTML($shop->item(0));
                $name = explode('"',$name)[1];
                $price = intval(str_replace(" ","",$doc->saveHTML($price->item(0))));
                $shopUrl = $doc->saveHTML($shopUrl->item(0));

                $shop = Shop::firstOrCreate(
                    ["name" => $name],
                    ["slug" => Str::of($shopUrl)->after('href="')->before('"')]
                );

                $productPrice = Price::firstOrCreate(
                    ["shop_id" => $shop->id],
                    ["product_id" => $product->id]
                );

                $productPrice->price = $price;
                $productPrice->save();
            }
        }

        $flash = [
            "type" => "success",
            "message" => "Sikeres mentés"
        ];

        return view("/add-product")->with(["flash" => $flash]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
