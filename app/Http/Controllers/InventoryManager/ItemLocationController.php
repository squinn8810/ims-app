<?php

namespace App\Http\Controllers\InventoryManager;

use App\Models\ItemLocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemLocationResource;
use App\Http\Resources\ItemLocationCollection;

/**
 * Controller for managing item locations.
 */
class ItemLocationController extends Controller
{
    /**
     * Display a listing of the item locations.
     *
     * @return \App\Http\Resources\ItemLocationCollection
     */
    public function index()
    {
        // Return a collection of all item locations as a JSON resource
        return new ItemLocationCollection(ItemLocation::all());
    }

    /**
     * Show the form for creating a new item location.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Form creation logic goes here
    }

    /**
     * Display the specified item location.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\ItemLocationResource
     */
    public function show(Request $request)
    {
        // Return a specific item location as a JSON resource
        return new ItemLocationResource(ItemLocation::findOrFail($request->itemLocID));
    }

    /**
     * Update the specified item location in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Update logic goes here
    }

    /**
     * Remove the specified item location from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        // Deletion logic goes here
    }
}
