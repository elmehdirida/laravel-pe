<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(User::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     $validated = validator($request->all(), [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8'],
         'role' => 'user',
    ]);
    if ($validated->fails()) {
        return response()->json($validated->errors(), 422);
    }

    $user = User::create(
        [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]
    );
    return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (User::where('id', $id)->doesntExist()) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
        return new UserResource(User::findOrFail($id));
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
            'name' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'unique:users,email,'.$id],
            'password' => ['string', 'min:8'],
        ]);
        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }
        $user = User::findOrFail($id);
        $user->update($request->all());
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (User::where('id', $id)->doesntExist()) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json( [
            'message' => 'User deleted successfully'
        ], 204);
    }

}
