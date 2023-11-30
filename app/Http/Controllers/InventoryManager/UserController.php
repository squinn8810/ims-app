<?php

namespace App\Http\Controllers\InventoryManager;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\InventoryManager\UserRequest;

/**
 * Controller for managing user resources.
 */
class UserController extends Controller
{
    /**
     * Display a listing of the user resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Return a collection of all users as a JSON resource
        $data = UserResource::collection(User::all());

        return response()->json($data, Response::HTTP_OK);


    }

    /**
     * Display the specified user resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find and return a specific user as a JSON resource
        $data = new UserResource(User::findOrFail($id));

        return response()->json($data, Response::HTTP_OK);

    }

    /**
     * Store a newly created user resource in storage.
     *
     * @param  UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Create a new user
        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'is_admin' => $request->is_admin,
        ]);

        // Return a JSON response indicating success
        return response()->json(['message' => 'User created successfully'], 201);
    }

    /**
     * Update the specified user resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Find the user by its ID
        $user = User::findOrFail($id);

        // Update the user attributes
        $user->update($request->only(['firstName', 'lastName', 'email', 'is_admin']));

        // Return a JSON response indicating success
        return response()->json(['message' => 'User updated successfully'], 200);
    }

    /**
     * Remove the specified user resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        // Find and delete the specified user
        $user = User::findOrFail($id);
        $user->delete();

        // Return a 204 No Content response
        return response()->json(null, 204);
    }
}
