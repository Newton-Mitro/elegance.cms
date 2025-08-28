<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageSectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Allow authorized users
    }

    public function rules(): array
    {
        return [
            'page_id' => ['sometimes', 'required', 'exists:pages,id'],
            'heading' => ['required', 'string', 'max:255'],
            'sub_heading' => ['nullable', 'string', 'max:255'],
            'button_text' => ['nullable', 'string', 'max:255'],
            'button_link' => ['nullable', 'url', 'max:255'],
            'content' => ['nullable', 'string'],
            'gallery' => ['nullable', 'array'],
            'gallery.*' => ['string'],
            'media_id' => ['nullable', 'exists:media,id'],
            'content_type' => ['nullable', 'in:json_array,custom_html'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
