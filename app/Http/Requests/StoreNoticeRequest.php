<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoticeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Allow authorized users
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:notices,slug'],
            'content' => ['nullable', 'string'],
            'publish_date' => ['required', 'date', 'before_or_equal:expiry_date'],
            'expiry_date' => ['nullable', 'date', 'after_or_equal:publish_date'],
            'status' => ['required', 'in:draft,published'],
        ];
    }
}
