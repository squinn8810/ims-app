<?php

namespace App\Http\Requests\InventoryManager;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'itemName' => 'required|unique:item|max:32',
            'itemURL' => 'required|max:128',
            'vendorName' => 'required',
            'locName' => 'required', 
            'reorderQty' => 'required|integer'
        ];
        
    }
}
