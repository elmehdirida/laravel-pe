<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all product with category and discount and all comments
        $products = Product::with(['category', 'discount', 'comments.user'])->get();
        return ProductResource::collection($products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = validator($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'discount_id' => ['required'],
            'category_id' => ['required'],
            'image' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'stock' => ['required', 'numeric']
        ]);
        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }
        $product = Product::create(
            [
                'name' => $request->name,
                'price' => $request->price,
                'discount_id' => $request->discount_id,
                'category_id' => $request->category_id,
                'image' => $request->image,
                'description' => $request->description,
                'stock' => $request->stock
            ]
        );
        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Product::where('id', $id)->doesntExist()) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }
        return new ProductResource(Product::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Product::where('id', $id)->doesntExist()) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }
        $product = Product::find($id);
        $product->update($request->all());
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Product::where('id', $id)->doesntExist()) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }
        Product::destroy($id);
        return response()->json([
            'message' => 'Product deleted'
        ], 200);
    }
}
