<?php

namespace App\Http\Controllers\InventoryManager;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserCollection;

/**
 * 
 */
class UserController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->isAdmin()) {
            return new UserCollection(User::all());;
        }
        return  response()->json(["message" => "Forbidden"], 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->isAdmin()) {
            return new UserResource(User::findOrFail($id));
        }
        return  response()->json(["message" => "Forbidden"], 403);
    }

    /**
     * 
     */
    public function store()
    {
    }

    /**
     * 
     */
    public function update()
    {
    }

    public function delete($id)
    {
        if (Auth::user()->isAdmin()) {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(null, 204);
        }

        return  response()->json(["message" => "Forbidden"], 403);
    }
}
