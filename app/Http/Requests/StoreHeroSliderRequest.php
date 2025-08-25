<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHeroSliderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Set to false if you want to restrict access
    }

    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'button_text' => ['nullable', 'string', 'max:100'],
            'button_link' => ['nullable', 'url'],
            'media_id' => ['required', 'exists:media,id'],
            'sort_order' => ['nullable', 'integer'],
            'status' => ['required', 'in:active,inactive'],
        ];
    }
}
