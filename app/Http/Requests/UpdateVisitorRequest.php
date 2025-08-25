<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVisitorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // or check if admin
    }

    public function rules(): array
    {
        $visitorId = $this->route('visitor')?->id; // assuming route model binding

        return [
            'session_id' => 'sometimes|string|unique:visitors,session_id,' . $visitorId,
            'ip_address' => 'nullable|ip',
            'user_agent' => 'nullable|string|max:1024',
            'device' => 'nullable|string|max:255',
            'browser' => 'nullable|string|max:255',
            'os' => 'nullable|string|max:255',
            'last_activity' => 'nullable|date',
        ];
    }
}
