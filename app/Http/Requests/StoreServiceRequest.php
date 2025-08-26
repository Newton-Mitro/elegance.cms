<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // allow authorized users
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:services,slug'],
            'description' => ['nullable', 'string'],
            'gallery' => ['nullable', 'array'],
            'gallery.*' => ['string'], // array of media URLs or paths
            'icon_media_id' => ['nullable', 'exists:media,id'],
            'media_id' => ['nullable', 'exists:media,id'],
            'status' => ['required', 'in:active,inactive'],
        ];
    }
}
