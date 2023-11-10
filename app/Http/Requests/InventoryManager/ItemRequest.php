<?php

namespace App\Http\Requests\InventoryManager;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->isAdmin();
    }

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
