<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAwardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // allow authorized users
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'organization' => ['nullable', 'string', 'max:255'],
            'year' => ['nullable', 'digits:4', 'integer', 'min:1900', 'max:' . date('Y')],
            'description' => ['nullable', 'string'],
            'media_id' => ['nullable', 'exists:media,id'],
        ];
    }
}
