<?php

namespace App\Http\Controllers\InventoryManager;

use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\VendorResource;
use App\Http\Resources\VendorCollection;

/**
 * Controller for managing vendors.
 */
class VendorController extends Controller
{
    /**
     * Display a listing of the vendors.
     *
     * @return \App\Http\Resources\VendorCollection
     */
    public function index()
    {
        // Return a collection of all vendors as a JSON resource
        return new VendorCollection(Vendor::all());
    }

    /**
     * Display the specified vendor resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\VendorResource
     */
    public function show(Request $request)
    {
        // Return a specific vendor as a JSON resource
        return new VendorResource(Vendor::findOrFail($request->vendorID));
    }

    /**
     * Show the form for creating a new vendor.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Form creation logic goes here
    }

    /**
     * Update the specified vendor resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Update logic goes here
    }

    /**
     * Remove the specified vendor resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        // Deletion logic goes here
    }
}
