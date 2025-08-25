<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'post_id' => 'sometimes|exists:posts,id',
            'user_id' => 'sometimes|nullable|exists:users,id',
            'author_name' => 'sometimes|nullable|string|max:255',
            'author_email' => 'sometimes|nullable|email|max:255',
            'content' => 'sometimes|string',
            'status' => 'sometimes|in:pending,approved,spam',
        ];
    }
}
