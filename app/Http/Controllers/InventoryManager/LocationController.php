<?php

namespace App\Http\Controllers\InventoryManager;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;
use App\Http\Resources\LocationCollection;

/**
 * 
 */
class LocationController extends Controller
{
    /**
     * 
     */
    public function index()
    {
        return new LocationCollection(Location::all());
    }

    /**
     * 
     */
    public function create()
    {
    }

    /**
     * 
     */
    public function show($id)
    {
        return new LocationResource(Location::findOrFail($id));
    }

    /**
     * 
     */
    public function update($id)
    {
    }

    /**
     * 
     */
    public function delete($id)
    {
    }
}
