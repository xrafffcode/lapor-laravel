<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReportStatusRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => 'required|string|in:Menunggu,Diproses,Selesai',
            'description' => 'required|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'status.required' => 'Status laporan harus diisi.',
            'status.string' => 'Status laporan harus berupa string.',
            'status.in' => 'Status laporan harus salah satu dari: Menunggu, Diproses, Selesai.',
            'description.string' => 'Deskripsi harus berupa string.',
            'description.required' => 'Deskripsi harus diisi.',
        ];
    }
}
