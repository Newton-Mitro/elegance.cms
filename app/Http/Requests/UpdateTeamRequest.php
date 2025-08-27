<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeamRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'designation' => ['sometimes', 'required', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'media_id' => ['nullable', 'exists:media,id'],
            'social_links' => ['nullable', 'array'],
            'social_links.*' => ['string'],
        ];
    }
}
