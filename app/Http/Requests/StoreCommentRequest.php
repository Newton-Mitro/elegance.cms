<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Return true if authentication/authorization is handled elsewhere
        return true;
    }

    public function rules(): array
    {
        return [
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'nullable|exists:users,id',
            'author_name' => 'nullable|string|max:255',
            'author_email' => 'nullable|email|max:255',
            'content' => 'required|string',
            'status' => 'nullable|in:pending,approved,spam',
        ];
    }

    public function prepareForValidation(): void
    {
        // Default status to 'pending' if not provided
        if (!$this->has('status')) {
            $this->merge(['status' => 'pending']);
        }
    }
}
