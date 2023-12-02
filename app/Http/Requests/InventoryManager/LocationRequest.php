<?php

namespace App\Http\Requests\InventoryManager;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
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
            'locName' => 'required|unique:location|max:32',
            'locAddress' => 'required|max:32',
            'locCity' => 'required|max:32',
            'locState' => 'required|max:2',
            'locZip' => 'required|max:5',
        ];
    }
}
