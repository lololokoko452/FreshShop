<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use App\Services\Admin\CategoryService;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view("admin.category.index", compact('categories'));
    }

    public function new()
    {
        return view("admin.category.new");
    }

    public function store(CategoryRequest $request, CategoryService $categoryService)
    {
        try {
            $category = $categoryService->saveNewCategory($request);

            return redirect()->route('admin.category.index')->with('success', 'Catégorie créée avec succès !');
        } catch (\Exception $e) {
            return redirect()->route('admin.category.new')->with('error', 'Une erreur est survenue');
        }
    }

    public function delete(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.category.index')->with('success', 'Catégorie supprimée avec succès !');
    }

}
