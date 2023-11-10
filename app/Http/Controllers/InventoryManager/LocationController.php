<?php

namespace App\Http\Controllers\InventoryManager;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;
use App\Http\Resources\LocationCollection;

/**
 * Controller for managing location resources.
 */
class LocationController extends Controller
{
    /**
     * Display a listing of the location resources.
     *
     * @return \App\Http\Resources\LocationCollection
     */
    public function index()
    {
        // Return a collection of all locations as a JSON resource
        return new LocationCollection(Location::all());
    }

    /**
     * Show the form for creating a new location.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Form creation logic goes here
    }

    /**
     * Display the specified location resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\LocationResource
     */
    public function show(Request $request)
    {
        // Return a specific location as a JSON resource
        return new LocationResource(Location::findOrFail($request->locID));
    }

    /**
     * Update the specified location resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Update logic goes here
    }

    /**
     * Remove the specified location resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        // Deletion logic goes here
    }
}
