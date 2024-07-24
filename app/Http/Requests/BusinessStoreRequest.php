<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusinessStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:businesses',
            'email' => 'required|string|email|max:255|unique:businesses',
            'category_ids' => 'nullable|array',
            'tag_ids' => 'nullable|array',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'business name',
            'email' => 'email',
            'category_id' => 'categories',
            'tag_ids' => 'tags',
        ];
    }
}
