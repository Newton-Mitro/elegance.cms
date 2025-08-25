<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Set to false if access should be restricted
    }

    public function rules(): array
    {
        return [
            'key' => ['required', 'string', 'max:255', 'unique:settings,key'],
            'value' => ['nullable', 'string'],
        ];
    }
}
