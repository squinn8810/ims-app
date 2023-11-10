<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\InventoryManager;

use App\Models\Transaction;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\TransactionCollection;

/**
 * 
 */
class TransactionController extends Controller
{
    /**
     * 
     */
    public function index()
    {
        return new TransactionCollection(Transaction::all());
    }

    /**
     * 
     */
    public function show($id)
    {
        return new TransactionResource(Transaction::findOrFail($id));
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
