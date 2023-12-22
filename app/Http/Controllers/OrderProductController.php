<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderProductResource;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = OrderProduct::all();
        return OrderProductResource::collection($orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = validator($request->all(), [
            'order_id' => ['required'],
            'product_id' => ['required'],
            'quantity' => ['required'],
            'price' => ['required'],
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }

        $orderProduct = OrderProduct::create([
            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);

        return new OrderProductResource($orderProduct);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {        $orderProducts = OrderProduct::where('order_id', $id)->get();
        return OrderProductResource::collection($orderProducts);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $orderProduct = OrderProduct::find($id);
        $orderProduct->quantity = $request->quantity;
        $orderProduct->price = $request->price;
        $orderProduct->total = $request->total;
        $orderProduct->save();
        return new OrderProductResource($orderProduct);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $orderProduct = OrderProduct::find($id);
        $orderProduct->delete();
        return response()->json(null, 204);
    }
}
