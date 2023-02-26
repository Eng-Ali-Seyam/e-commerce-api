<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' =>true ,
            'message' => 'Success',
            'data' => Product::all(),
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $product = Product::create($input);
        return response()->json([
            "success" => true,
            "message" => "Product created successfully.",
            "data" => $product
        ],201);
    }

    public function show($id)
    {

        $product = Product::find($id);
        if (is_null($product)) {
            return response()->json([
                "success" => false,
                "message" => "Product Not Found",
            ],404);
        }
        return response()->json([
            "success" => true,
            "message" => "Product retrieved successfully.",
            "data" => $product
        ]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->title = $request->title ;
        $product->price = $request->price ;
        $product->old_price = $request->old_price ;
        $product->image = $request->image ;
        $product->available = $request->available ;
        $product->category_id = $request->category_id ;
        $product->save();

        return response()->json([
            "success" => true,
            "message" => "Product updated successfully.",
            "data" => $product
        ]);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            "success" => true,
            "message" => "Product deleted successfully.",
            "data" => $product
        ]);
    }
}
