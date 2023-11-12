<?php

namespace App\Http\Controllers\InventoryManager;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\InventoryManager\LocationRequest;
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
     * @param  \Illuminate\Http\Request\InventoryManager\LocationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function create(LocationRequest $request)
    {
        // Form creation logic goes here
    }

    /**
     * Display the specified location resource.
     *
     * @param  int  $locID
     * @return \App\Http\Resources\LocationResource
     */
    public function show($locID)
    {
        // Return a specific location as a JSON resource
        return new LocationResource(Location::findOrFail($locID));
    }

    /**
     * Update the specified location resource in storage.
     *
     * @param  \Illuminate\Http\Request\InventoryManager\LocationRequest  $request
     * @param  int  $locID
     * @return \Illuminate\Http\Response
     */
    public function update(LocationRequest $request, $locID)
    {
        // Find the location by its ID
        $location = Location::findOrFail($locID);

        // Update the location attributes
        $location->update($request->only(['locName', 'locAddress', 'locCity', 'locState', 'locZip']));

        // Return a JSON response indicating success
        return response()->json(['message' => 'Location updated successfully'], 200);
    }

    /**
     * Remove the specified location resource from storage.
     *
     * @param  int  $locID
     * @return \Illuminate\Http\Response
     */
    public function delete($locID)
    {
        // Find and delete the specified location
        $location = Location::findOrFail($locID);
        $location->delete();

        // Return a JSON response indicating success
        return response()->json(['message' => 'Location deleted successfully'], 200);
    }
}
