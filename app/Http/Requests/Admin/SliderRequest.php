<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SliderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $entityId = $this->route()->parameter('slider')?->id;

        return [
            'description1' => [
                'required'
            ],
            'description2' => [
                'required'
            ],
            'image' => [
                'required',
                'image',
                Rule::file()->max(2048),
            ],
        ];
    }

    public function messages()
    {
        return [
            'description1.required' => 'The description1 field is required.',
            'description2.required' => 'The description2 field is required.',
            'image.required' => 'The image field is required.',
            'image.image' => 'The file must be an image.',
            'image.max' => 'The image may not be greater than 2048 kilobytes.',
        ];
    }

}
