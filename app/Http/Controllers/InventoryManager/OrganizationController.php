<?php

namespace App\Http\Controllers\InventoryManager;

use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrganizationResource;

/**
 * Controller for managing organization resources.
 */
class OrganizationController extends Controller
{
    /**
     * Display a listing of the organization resources.
     *
     * @return \App\Http\Resources\OrganizationResource
     */
    public function index()
    {
        // Return a collection of all organizations as a JSON resource
        return new OrganizationResource(Organization::all());
    }

    /**
     * Update the specified organization resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Update logic goes here
    }
}
