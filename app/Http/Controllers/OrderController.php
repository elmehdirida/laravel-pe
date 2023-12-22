<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;
use Illuminate\Validation\Validator;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get orders with products
        $orders = Order::with('products','user')->get();
        return OrderResource::collection($orders);
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
            'order_date' => ['required', 'date'],
            'order_status' => ['required', 'string'],
            'total_amount' => ['required'],
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }




        $order = Order::create([
                'order_date' => $request->order_date,
                'order_status' => $request->order_status,
                'total_amount' => $request->total_amount,
                'user_id' => $request->user_id,
                ]);

        return new OrderResource($order);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'message' => 'Order not found'
            ], 404);
        }
        return new OrderResource($order);
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = validator($request->all(), [
            'order_date' => ['required', 'date'],
            'order_status' => ['required', 'min:8', 'string'],
            'total_amount' => ['required'],
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }



        $order = Order::findOrFail($id);

        $order->update($request->all());

        return new OrderResource($order);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Order::find($id)) {
            return response()->json([
                'message' => 'Order not found'
            ], 404);
        }
        $order = Order::findOrFail($id);

        $order->delete();

        return response()->json(null, 204);
    }
}
