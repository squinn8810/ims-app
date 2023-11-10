<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\InventoryManager;

use App\Models\Vendor;
use App\Http\Controllers\Controller;
use App\Http\Resources\VendorResource;
use App\Http\Resources\VendorCollection;

/**
 * 
 */
class VendorController extends Controller
{
    /**
     * 
     */
    public function index()
    {
        return new VendorCollection(Vendor::all());
    }

    /**
     * 
     */
    public function show($id)
    {
        return new VendorResource(Vendor::findOrFail($id));
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
