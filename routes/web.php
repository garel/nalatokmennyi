<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', "ShopController@index");
Route::get('/products', "ProductController@index");
Route::get("/prices-by-shop/{shop}","PriceController@PricesByShop");
Route::get("/prices-by-product/{product}","PriceController@PricesByProduct");
Route::get("/add-product","ProductController@create");
Route::post("/add-product","ProductController@store");

