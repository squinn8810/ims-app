<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UpdateUserRequest extends FormRequest
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
            'firstName' => 'required|max:32',
            'lastName' => 'required|max:32',
            'email' => 'required|max:32',
            'is_admin' => 'required', 
            'id' => 'required|unique:item|integer'
        ];
        
    }
}
