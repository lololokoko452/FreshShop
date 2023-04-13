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

        return [
            'name' => [
                'required',
                Rule::unique('categories', 'name')->ignore($entityId),
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The category name is required.',
            'name.unique' => 'The gategory name must be unique.'
        ];
    }
}
