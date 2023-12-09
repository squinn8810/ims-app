<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
           // Validation rules
           return [
            'firstName' => 'required|max:32',
            'lastName' => 'required|max:32',
            'email' => 'required|max:32',
            'id' => 'required|unique:item|integer'
        ];
    }
}
