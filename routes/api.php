<?php

use App\Http\Controllers\API\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// GET|HEAD        api/products .......................................... products.index › API\ProductController@index
// POST            api/products .......................................... products.store › API\ProductController@store
// GET|HEAD        api/products/create ................................. products.create › API\ProductController@create
// GET|HEAD        api/products/{product} .................................. products.show › API\ProductController@show
// PUT|PATCH       api/products/{product} .............................. products.update › API\ProductController@update
// DELETE          api/products/{product} ............................ products.destroy › API\ProductController@destroy
// GET|HEAD        api/products/{product}/edit ............................. products.edit › API\ProductController@edit
Route::resource('products', ProductController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
