<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'file_name' => ['sometimes', 'required', 'string', 'max:255'],
            'file' => ['sometimes', 'file', 'mimes:jpg,jpeg,png,gif,webp,svg,pdf,doc,docx', 'max:10240'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'uploaded_by' => ['nullable', 'exists:users,id'],
        ];
    }
}
