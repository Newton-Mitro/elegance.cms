<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTagRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Change to true if authentication is handled elsewhere
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:tags,name',
            'slug' => 'nullable|string|max:255|unique:tags,slug',
        ];
    }

    public function prepareForValidation(): void
    {
        if (!$this->slug && $this->name) {
            $this->merge([
                'slug' => \Str::slug($this->name),
            ]);
        }
    }
}
