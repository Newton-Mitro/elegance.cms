<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCareerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Change if you need role-based access control
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:careers,slug'],
            'description' => ['nullable', 'string'],
            'requirements' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'salary_range' => ['nullable', 'string', 'max:255'],
            'deadline' => ['nullable', 'date', 'after_or_equal:today'],
            'status' => ['required', 'in:open,closed'],
        ];
    }
}
