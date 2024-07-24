<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusinessUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:businesses,name,' . $this->business->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:businesses,email,' . $this->business->id],
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
