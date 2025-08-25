<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $tagId = $this->route('tag'); // Assuming route model binding or ID param

        return [
            'name' => "required|string|max:255|unique:tags,name,{$tagId}",
            'slug' => "nullable|string|max:255|unique:tags,slug,{$tagId}",
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
