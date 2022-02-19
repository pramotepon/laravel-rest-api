<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch Product Data desc
        $product = Product::latest()->get();
        // Return Response json data success
        return response()->json([ProductResource::collection($product), 'Product fetched.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate Request All
        $validator = Validator::make($request->all(),[
            'name'    => 'required|string|max:255',
            'price'    => 'required|integer',
            'quantity'    => 'required|integer',
        ]);
        // If Validate fail
        if($validator->fails()){
            // Return response json Error Validate
            return response()->json($validator->errors());
        }

        // Created Product Data
        $product = Product::create([
            'name'    => $request->name,
            'desc'    => $request->desc,
            'price'    => $request->price,
            'quantity'    => $request->quantity,
        ]);

        // Return Response json data created success
        return response()->json(['Product Created Successfully', new ProductResource($product)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // Return Response json data fetch success
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // Validate Request All
        $validator = Validator::make($request->all(),[
            'name'    => 'required|string|max:255',
            'price'    => 'required|integer',
            'quantity'    => 'required|integer',
        ]);
        // If Validate fail
        if($validator->fails()){
            // Return response json Error Validate
            return response()->json($validator->errors());
        }

        // set product.field = request.data
        $product->name  =   $request->name;
        $product->desc  =   $request->desc;
        $product->price  =   $request->price;
        $product->quantity  =   $request->quantity;
        // update product data
        $product->save();
        // Return Response json data updated success
        return response()->json(['Product updated Successfully', new ProductResource($product)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // deleted product data
        $product->delete();
        // Return Response json data deleted success
        return response()->json('Product deleted Successfully');
    }
}
