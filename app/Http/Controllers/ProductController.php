<?php

namespace App\Http\Controllers;

use App\Events\NewProductEvent;
use App\Http\Requests\ProductRequest;
use App\Jobs\SendNewProductMail;
use App\Models\Category;
use App\Models\Product;
use Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('dashboard.all_products',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.add_product',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        $file=$request->file('image');
        $filename=$file->getClientOriginalName();
        $file=$request->file('image')->storeAs('products',$filename,'products_images');
        $product =Product::create([
            'title'  => \request('title') ,
            'price'  => (int)\request('price') ,
            'old_price'  => (int)\request('old_price') ,
            'image'  =>$filename,
            'available'  => \request('available'),
            'category_id'  => \request('category') ,
        ]);
        SendNewProductMail::dispatch($product)->delay( now()->seconds(5));

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findorFail($id);
        $categories = Category::all();
        return view('dashboard.edit_product',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductRequest $request, Product $product)
    {

        $product->title = $request->title ;
        $product->price = $request->price ;
        $product->old_price = $request->old_price ;
        $file=$request->file('image');
        $filename=$file->getClientOriginalName();
        $file=$request->file('image')->storeAs('products',$filename,'products_images');
        $product->image = $filename ;
        $product->available = $request->available ;
        $product->category_id = $request->category ;
        $product->save();


        return redirect()->route('products.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
