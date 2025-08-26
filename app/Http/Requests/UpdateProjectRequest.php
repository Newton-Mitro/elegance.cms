<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // allow authorized users
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'slug' => ['sometimes', 'required', 'string', 'max:255', 'unique:projects,slug,' . $this->route('project')],
            'description' => ['nullable', 'string'],
            'category' => ['nullable', 'string', 'max:255'],
            'source_code_link' => ['nullable', 'url', 'max:255'],
            'live_site_link' => ['nullable', 'url', 'max:255'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'gallery' => ['nullable', 'array'],
            'gallery.*' => ['string'],
            'media_id' => ['nullable', 'exists:media,id'],
            'status' => ['sometimes', 'required', 'in:active,inactive'],
        ];
    }
}
