<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTestimonialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'author_name' => ['sometimes', 'required', 'string', 'max:255'],
            'author_designation' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'message' => ['sometimes', 'required', 'string'],
            'media_id' => ['nullable', 'exists:media,id'],
            'rating' => ['nullable', 'integer', 'between:1,5'],
        ];
    }
}
