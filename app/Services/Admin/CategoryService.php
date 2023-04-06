<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CategoryService extends AdminService
{

    public function saveNewCategory(CategoryRequest $request): Model|Category
    {
        $validatedData = $request->validated();

        // Validation des données
        $validator = Validator::make($validatedData, [
            'name' => 'required|unique:categories,name'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        // Création de la catégorie
        return $this->create(Category::class, collect($validatedData));
    }


}
