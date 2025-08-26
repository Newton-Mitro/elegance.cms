<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Allow authorized users
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:products,slug'],
            'description' => ['nullable', 'string'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'gallery' => ['nullable', 'array'],
            'gallery.*' => ['string'], // each item is a URL/path
            'media_id' => ['nullable', 'exists:media,id'],
            'status' => ['required', 'in:active,inactive'],
        ];
    }
}
