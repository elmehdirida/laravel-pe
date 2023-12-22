<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiscountResource;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DiscountResource::collection(Discount::all());
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
            'code' => ['required', 'string'],
            'discount' => ['required'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ]);
        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }

        $discount = Discount::create([
            'code' => $request->code,
            'discount' => $request->discount,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        return new DiscountResource($discount);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Discount::find($id) === null) {
            return response()->json(['message' => 'Discount not found'], 404);
        }
        return new DiscountResource(Discount::find($id));
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
            'code' => ['required', 'string'],
            'discount' => ['required'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ]);
        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }

        $discount = Discount::find($id);
        $discount->update($request->all());
        return new DiscountResource($discount);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Discount::find($id) === null) {
            return response()->json(['message' => 'Discount not found'], 404);
        }
        Discount::find($id)->delete();
        return response()->json(['message' => 'Discount deleted successfully'], 200);
    }
}
