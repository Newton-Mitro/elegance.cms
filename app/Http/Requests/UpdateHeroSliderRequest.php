<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHeroSliderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'nullable', 'string', 'max:255'],
            'subtitle' => ['sometimes', 'nullable', 'string', 'max:255'],
            'button_text' => ['sometimes', 'nullable', 'string', 'max:100'],
            'button_link' => ['sometimes', 'nullable', 'url'],
            'media_id' => ['sometimes', 'required', 'exists:media,id'],
            'sort_order' => ['sometimes', 'integer'],
            'status' => ['sometimes', 'required', 'in:active,inactive'],
        ];
    }
}
