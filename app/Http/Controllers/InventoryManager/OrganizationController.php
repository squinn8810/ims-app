<?php

namespace App\Http\Controllers\InventoryManager;

use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\InventoryManager\OrganizationRequest;
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
     * Display the specified organization resource.
     *
     * @param  int  $id
     * @return \App\Http\Resources\OrganizationResource
     */
    public function show($id)
    {
        // Return a specific organization as a JSON resource
        return new OrganizationResource(Organization::findOrFail($id));
    }

    /**
     * Update the specified organization resource in storage.
     *
     * @param  \Illuminate\Http\Request\InventoryManager\OrganizationRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrganizationRequest $request, $id)
    {
        // Find the organization by its ID
        $organization = Organization::findOrFail($id);

        // Update the organization attributes
        $organization->update($request->only(['name', 'address', 'city', 'state', 'zip']));

        // Return a JSON response indicating success
        return response()->json(['message' => 'Organization updated successfully'], 200);
    }
}
