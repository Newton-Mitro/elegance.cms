<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGalleryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'media_id' => ['sometimes', 'required', 'exists:media,id'],
            'category' => ['nullable', 'string', 'max:100'],
            'status' => ['sometimes', 'required', 'in:active,inactive'],
        ];
    }
}
