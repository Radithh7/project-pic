<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',  // Validasi untuk nama
            'email' => 'required|email|unique:users,email', // Validasi untuk email (unikt) 
            'password' => 'required|string|confirmed|min:8', // Validasi untuk password (min 8 karakter)
            'password_confirmation' => 'required|same:password', // Validasi untuk konfirmasi password
        ];
    }
}
