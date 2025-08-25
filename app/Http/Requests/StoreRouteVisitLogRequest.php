<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRouteVisitLogRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Usually true; adjust if only admin can log manually
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'nullable|exists:users,id',
            'route' => 'required|string|max:255',
            'method' => 'required|string|in:GET,POST,PUT,PATCH,DELETE,OPTIONS',
            'ip_address' => 'nullable|ip',
            'user_agent' => 'nullable|string|max:1024',
            'query_params' => 'nullable|json',
            'request_body' => 'nullable|json',
            'visited_at' => 'nullable|date',
        ];
    }
}
