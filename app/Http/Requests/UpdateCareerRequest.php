<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCareerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'slug' => ['sometimes', 'required', 'string', 'max:255', 'unique:careers,slug,' . $this->route('career')],
            'description' => ['nullable', 'string'],
            'requirements' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'salary_range' => ['nullable', 'string', 'max:255'],
            'deadline' => ['nullable', 'date', 'after_or_equal:today'],
            'status' => ['sometimes', 'required', 'in:open,closed'],
        ];
    }
}
