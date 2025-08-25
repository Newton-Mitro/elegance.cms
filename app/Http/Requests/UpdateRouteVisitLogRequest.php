<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRouteVisitLogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // adjust according to your logic
    }

    public function rules(): array
    {
        return [
            'user_id' => 'sometimes|nullable|exists:users,id',
            'route' => 'sometimes|string|max:255',
            'method' => 'sometimes|string|in:GET,POST,PUT,PATCH,DELETE,OPTIONS',
            'ip_address' => 'sometimes|nullable|ip',
            'user_agent' => 'sometimes|nullable|string|max:1024',
            'query_params' => 'sometimes|nullable|json',
            'request_body' => 'sometimes|nullable|json',
            'visited_at' => 'sometimes|nullable|date',
        ];
    }
}
