<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVisitorRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Usually allowed for anyone or admin depending on your logic
        return true;
    }

    public function rules(): array
    {
        return [
            'session_id' => 'required|string|unique:visitors,session_id',
            'ip_address' => 'nullable|ip',
            'user_agent' => 'nullable|string|max:1024',
            'device' => 'nullable|string|max:255',
            'browser' => 'nullable|string|max:255',
            'os' => 'nullable|string|max:255',
            'last_activity' => 'nullable|date',
        ];
    }
}
