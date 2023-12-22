<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PaymentResource::collection(Payment::all());
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
            'order_id' => ['required','max:5'],
            'payment_method' => ['required', 'string'],
            'payment_status' => ['required', 'string'],
            'amount' => ['required'],
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }

        $payment = Payment::create([
            'order_id' => $request->order_id,
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_status,
            'amount' => $request->amount,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!Payment::find($id)) {
            return response()->json([
                'message' => 'Payment not found'
            ], 404);
        }
        return new PaymentResource(Payment::findOrFail($id));
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
        $validated = validator($request->all(), [
            'order_id' => ['required','max:5'],
            'payment_method' => ['required', 'string'],
            'payment_status' => ['required', 'string'],
            'amount' => ['required'],
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }

        $payment = Payment::findOrFail($id);
        $payment->update($request->all());

        return new PaymentResource($payment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return response()->json([
            'message' => 'Payment deleted successfully'
        ], 200);
    }
}
