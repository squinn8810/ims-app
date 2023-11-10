<?php

namespace App\Http\Controllers\InventoryManager;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserCollection;

/**
 * Controller for managing user resources.
 */
class UserController extends Controller
{
    /**
     * Display a listing of the user resources.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Check if the authenticated user is an admin
        if ($request->user()->isAdmin()) {
            // Return a collection of all users as a JSON resource
            return new UserCollection(User::all());
        }
        
        // If not an admin, return a 403 Forbidden response
        return response()->json(["message" => "Forbidden"], 403);
    }

    /**
     * Display the specified user resource.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // Check if the authenticated user is an admin
        if ($request->user()->isAdmin()) {
            // Return a specific user as a JSON resource
            return new UserResource(User::findOrFail($request->id));
        }

        // If not an admin, return a 403 Forbidden response
        return response()->json(["message" => "Forbidden"], 403);
    }

    /**
     * Store a newly created user resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Store logic goes here
    }

    /**
     * Update the specified user resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Update logic goes here
    }

    /**
     * Remove the specified user resource from storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        // Check if the authenticated user is a superuser
        if ($request->user()->isSuperuser()) {
            // Find and delete the specified user
            $user = User::findOrFail($request->id);
            $user->delete();
            
            // Return a 204 No Content response
            return response()->json(null, 204);
        }

        // If not a superuser, return a 403 Forbidden response
        return response()->json(["message" => "Forbidden"], 403);
    }
}
