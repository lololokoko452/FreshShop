<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $entityId = $this->route()->parameter('category')?->id;

        $rules = [
            'name' => [
                'required',
                Rule::unique('categories', 'name')->ignore($entityId),
            ]
        ];
        if ($this->isMethod('POST')) {
            // Add validation rule for image when creating a new slider
            $rules['image'] = [
                'required',
                'image',
                Rule::file()->max(2048),
            ];
        } else {
            // Add validation rule for image when updating a slider
            $rules['image'] = [
                'nullable',
                'image',
                Rule::file()->max(2048),
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'The category name is required.',
            'name.unique' => 'The category name must be unique.',
            'image.required' => 'The image field is required.',
            'image.image' => 'The file must be an image.',
            'image.max' => 'The image may not be greater than 2048 kilobytes.'
        ];
    }
}
