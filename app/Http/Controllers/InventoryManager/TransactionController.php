<?php

namespace App\Http\Controllers\InventoryManager;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\TransactionCollection;

/**
 * Controller for managing transactions.
 */
class TransactionController extends Controller
{
    /**
     * Display a listing of the transactions.
     *
     * @return \App\Http\Resources\TransactionCollection
     */
    public function index()
    {
        // Return a collection of all transactions as a JSON resource
        return new TransactionCollection(Transaction::all());
    }

    /**
     * Display the specified transaction resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\TransactionResource
     */
    public function show(Request $request)
    {
        // Return a specific transaction as a JSON resource
        return new TransactionResource(Transaction::findOrFail($request->transNum));
    }

    /**
     * Show the form for creating a new transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Form creation logic goes here
    }

    /**
     * Update the specified transaction resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        // Update logic goes here
    }

    /**
     * Remove the specified transaction resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        // Deletion logic goes here
    }
}
