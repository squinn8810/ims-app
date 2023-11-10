<?php

namespace App\Http\Controllers\InventoryManager;

use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrganizationResource;

/**
 * 
 */
class OrganizationController extends Controller
{
    /**
     * 
     */
    public function index()
    {
        return new OrganizationResource(Organization::all());
    }


    /**
     * 
     */
    public function update($id)
    {
    }
}
