<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['sometimes', 'required', 'exists:users,id'],
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'slug' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('posts', 'slug')->ignore($this->route('post'))
            ],
            'content' => ['sometimes', 'required', 'string'],
            'cover_image' => ['sometimes', 'nullable', 'string'],
            'status' => ['sometimes', 'required', 'in:draft,published,archived'],
            'published_at' => ['sometimes', 'nullable', 'date'],
        ];
    }
}
