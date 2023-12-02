<?php

namespace App\Http\Controllers\InventoryManager;

use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\InventoryManager\VendorRequest;
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
     * @param  int  $vendorID
     * @return \App\Http\Resources\VendorResource
     */
    public function show($vendorID)
    {
        // Return a specific vendor as a JSON resource
        return new VendorResource(Vendor::findOrFail($vendorID));
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
     * @param  \Illuminate\Http\Request\InventoryManager\VendorRequest  $request
     * @param  int  $vendorID
     * @return \Illuminate\Http\Response
     */
    public function update(VendorRequest $request, $vendorID)
    {
        // Find the vendor by its ID
        $vendor = Vendor::findOrFail($vendorID);

        // Update the vendor attributes
        $vendor->update($request->only(['name', 'other_attributes'])); // Adjust attributes accordingly

        // Return a JSON response indicating success
        return response()->json(['message' => 'Vendor updated successfully'], 200);
    }

    /**
     * Remove the specified vendor resource from storage.
     *
     * @param  int  $vendorID
     * @return \Illuminate\Http\Response
     */
    public function delete($vendorID)
    {
        // Find and delete the specified vendor
        $vendor = Vendor::findOrFail($vendorID);
        $vendor->delete();

        // Return a 204 No Content response
        return response()->json(null, 204);
    }
}
