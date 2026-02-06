<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // add policy later
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'slug'        => 'required|string|max:255|unique:categories,slug',
            'description' => 'nullable|string',
            'parent_id'   => 'nullable|exists:categories,id'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Category name is required.',
            'slug.unique'   => 'This category slug already exists.',
            'parent_id.exists' => 'Parent category does not exist.',
        ];
    }
}
