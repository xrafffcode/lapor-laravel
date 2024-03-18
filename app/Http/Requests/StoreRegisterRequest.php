<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:255|confirmed',
            'password_confirmation' => 'required|string|min:8|max:255',
        ];
    }

    public function attributes(): array
    {
        return [
            'full_name' => 'Nama Lengkap',
            'email' => 'Email',
            'password' => 'Password',
            'password_confirmation' => 'Konfirmasi Password',
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => ':attribute wajib diisi.',
            'full_name.string' => ':attribute harus berupa string.',
            'full_name.max' => ':attribute maksimal 255 karakter.',
            'email.required' => ':attribute wajib diisi.',
            'email.string' => ':attribute harus berupa string.',
            'email.email' => ':attribute harus berupa email.',
            'email.max' => ':attribute maksimal 255 karakter.',
            'email.unique' => ':attribute sudah terdaftar.',
            'password.required' => ':attribute wajib diisi.',
            'password.string' => ':attribute harus berupa string.',
            'password.min' => ':attribute minimal 8 karakter.',
            'password.max' => ':attribute maksimal 255 karakter.',
            'password.confirmed' => ':attribute tidak cocok.',
            'password_confirmation.required' => ':attribute wajib diisi.',
            'password_confirmation.string' => ':attribute harus berupa string.',
            'password_confirmation.min' => ':attribute minimal 8 karakter.',
            'password_confirmation.max' => ':attribute maksimal 255 karakter.',
        ];
    }
}
