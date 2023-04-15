<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $entityId = $this->route()->parameter('product')?->id;

        $rules = [
            'name' => [
                'required',
                Rule::unique('products', 'name')->ignore($entityId),
            ],
            'price' => [
                'required'
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
            'name.required' => 'The name field is required.',
            'name.unique' => 'This name is already used',
            'price.required' => 'The price field is required.',
            'image.required' => 'The image field is required.',
            'image.image' => 'The file must be an image.',
            'image.max' => 'The image may not be greater than 2048 kilobytes.',
        ];
    }

}
