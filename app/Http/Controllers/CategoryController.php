<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CategoryResource::collection(Category::all());
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
                'description' => ['required', 'string', 'max:255'],
            ]);
            if ($validated->fails()) {
                return response()->json($validated->errors(), 422);
            }
            $category = Category::create(
                [
                    'name' => $request->name,
                    'description' => $request->description
                ]
            );
            return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Category::where('id', $id)->doesntExist()) {
            return response()->json([
                'message' => 'Category not found'
            ], 404);
        }
        return new CategoryResource(Category::find($id));
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
        if (Category::where('id', $id)->doesntExist()) {
            return response()->json([
                'message' => 'Category not found'
            ], 404);
        }
        $category = Category::find($id);
        $category->update($request->all());
        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Category::where('id', $id)->doesntExist()) {
            return response()->json([
                'message' => 'Category not found'
            ], 404);
        }
        Category::destroy($id);
        return response()->json([
            'message' => 'Category deleted successfully'
        ]);
    }
}
