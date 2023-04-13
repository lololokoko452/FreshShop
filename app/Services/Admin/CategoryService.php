<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class CategoryService extends AdminService
{
    public function saveNewCategory(CategoryRequest $request)
    {
        return $this->create(Category::class, $request->validated());
    }

    public function updateCategory(Category $category, CategoryRequest $request)
    {
        return $this->update($category, $request->validated());
    }
}
