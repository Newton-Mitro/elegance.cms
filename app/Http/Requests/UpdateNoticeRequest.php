<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNoticeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'slug' => ['sometimes', 'required', 'string', 'max:255', 'unique:notices,slug,' . $this->route('notice')],
            'content' => ['nullable', 'string'],
            'publish_date' => ['sometimes', 'required', 'date', 'before_or_equal:expiry_date'],
            'expiry_date' => ['nullable', 'date', 'after_or_equal:publish_date'],
            'status' => ['sometimes', 'required', 'in:draft,published'],
        ];
    }
}
