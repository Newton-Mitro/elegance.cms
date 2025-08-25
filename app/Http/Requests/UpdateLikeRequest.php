<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLikeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'post_id' => 'sometimes|exists:posts,id',
            'user_id' => 'sometimes|exists:users,id',
        ];
    }
}
