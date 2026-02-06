<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $categoryId = $this->route('id');

        return [
            'name'        => 'sometimes|string|max:255',
            'slug'        => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('categories', 'slug')->ignore($categoryId),
            ],
            'description' => 'nullable|string',
            'parent_id'   => [
                'nullable',
                'exists:categories,id',
                'not_in:' . $categoryId, // prevent self-parenting
            ],
            'is_active'   => 'sometimes|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'slug.unique' => 'This slug is already in use.',
            'parent_id.not_in' => 'A category cannot be its own parent.',
        ];
    }
}
