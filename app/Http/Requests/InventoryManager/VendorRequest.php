<?php

namespace App\Http\Requests\InventoryManager;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
         // Validation rules
         return [
            'vendorName' => 'required|unique:vendor|max:32',
            'vendorEmail' => 'unique:vendor|max:64',
            'vendorPhone' => 'unique:vendor|max:20', 
            'vendorURL' => 'required|unique:vendor|max:128'
         ];
    }
}
