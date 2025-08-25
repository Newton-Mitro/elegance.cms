<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGalleryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // adjust if you use roles/permissions
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'media_id' => ['required', 'exists:media,id'],
            'category' => ['nullable', 'string', 'max:100'],
            'status' => ['required', 'in:active,inactive'],
        ];
    }
}
