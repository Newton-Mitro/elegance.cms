<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLikeRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Usually only authenticated users can like
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
