<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Cassandra\Date;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::with(['user'])->get();
        return CommentResource::collection($comments);
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
            'text' => ['required', 'string', 'max:255'],
            'rating' => ['required', 'numeric'],
            'user_id' => ['required', 'numeric'],
            'product_id' => ['required', 'numeric'],
        ]);
        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }
        $comment = Comment::create(
            [
                'text' => $request->text,
                'rating' => $request->rating,
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
                'date' => date('Y-m-d H:i:s'),
            ]
        );
        $comment->load('user');
        return new CommentResource($comment);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Comment::where('id', $id)->doesntExist()) {
            return response()->json([
                'message' => 'Comment not found'
            ], 404);
        }
        return new CommentResource(Comment::find($id));
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
        if (Comment::where('id', $id)->doesntExist()) {
            return response()->json([
                'message' => 'Comment not found'
            ], 404);
        }
        $comment = Comment::find($id);
        $comment->update($request->all());
        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Comment::where('id', $id)->doesntExist()) {
            return response()->json([
                'message' => 'Comment not found'
            ], 404);
        }
        Comment::find($id)->delete();
        return response()->json([
            'message' => 'Comment deleted successfully'
        ], 200);
    }
    /**
     * Display comments by product ID.
     */
    public function commentByProductId($productId)
    {
        $comments = Comment::where('product_id', $productId)->with(['user'])->get();
        return CommentResource::collection($comments);
    }

}
