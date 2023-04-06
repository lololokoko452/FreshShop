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
        $category = $this->route('category');

        return [
            'name' => [
                'required',
                Rule::unique('categories', 'name')->ignore($category ? $category->id : null)
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le nom de la catégorie est requis.',
            'name.unique' => 'Le nom de la catégorie doit être unique.'
        ];
    }
}
