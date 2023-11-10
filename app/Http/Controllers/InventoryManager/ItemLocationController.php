<?php

namespace App\Http\Controllers\InventoryManager;

use App\Models\ItemLocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemLocationResource;
use App\Http\Resources\ItemLocationCollection;

/**
 * 
 */
class ItemLocationController extends Controller
{
    /**
     * 
     */
    public function index() {
        return new ItemLocationCollection(ItemLocation::all());
    }

      /**
     * 
     */
    public function create() {

    }
    
    /**
     * 
     */
    public function show($id)
    {
        return new ItemLocationResource(ItemLocation::findOrFail($id));
    }

    /**
     * 
     */
    public function update($id) {

    }

    /**
     * 
     */
    public function delete($id) {

    }


}
