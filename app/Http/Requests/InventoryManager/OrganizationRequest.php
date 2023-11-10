<?php

namespace App\Http\Requests\InventoryManager;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationRequest extends FormRequest
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
            'name' => 'required|unique:location|max:32',
            'address' => 'required|max:32',
            'city' => 'required|max:32',
            'state' => 'required|max:2',
            'zip' => 'required|max:5',
            'phone' => 'required|max:20',
        ];
    }
}
