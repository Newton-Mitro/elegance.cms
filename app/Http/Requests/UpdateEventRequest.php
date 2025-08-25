<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'slug' => ['sometimes', 'required', 'string', 'max:255', 'unique:events,slug,' . $this->route('event')],
            'description' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'start_date' => ['sometimes', 'required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'banner_media_id' => ['nullable', 'exists:media,id'],
            'status' => ['sometimes', 'required', 'in:active,inactive'],
        ];
    }
}
