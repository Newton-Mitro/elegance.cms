<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // allow authorized users
    }

    public function rules(): array
    {
        return [
            'file' => [
                'required',
                'file',
                // 'mimes:jpg,jpeg,png,gif,webp,svg,pdf,doc,docx',
                'max:100240', // 10MB max
            ],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'uploaded_by' => ['nullable', 'exists:users,id'],
        ];
    }
}
