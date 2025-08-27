<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // allow authorized users
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'designation' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'media_id' => ['nullable', 'exists:media,id'],
            'social_links' => ['nullable', 'array'],
            'social_links.*' => ['string'], // each social link as string
        ];
    }
}
