<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'slug' => ['sometimes', 'required', 'string', 'max:255', 'unique:products,slug,' . $this->route('product')],
            'description' => ['nullable', 'string'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'gallery' => ['nullable', 'array'],
            'gallery.*' => ['string'],
            'media_id' => ['nullable', 'exists:media,id'],
            'status' => ['sometimes', 'required', 'in:active,inactive'],
        ];
    }
}
