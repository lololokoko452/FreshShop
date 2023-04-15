<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use App\Services\Admin\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view("admin.category.index", compact('categories'));
    }

    public function form(Category|null $category): View
    {
        $formAction = $category?->id ? route('admin.category.update', $category) : route('admin.category.store');

        return view("admin.category.form", compact("category", "formAction"));
    }

    public function store(CategoryRequest $request, CategoryService $categoryService)
    {
        try {
            $categoryService->saveNewCategory($request);

            return redirect()->route('admin.category.index')->with('success', 'Category created successfuly');
        } catch (\Exception $e) {
            return redirect()->route('admin.category.new')->with('error', 'Error');
        }
    }

    public function update(CategoryRequest $request, CategoryService $categoryService, Category $category): RedirectResponse
    {
        try {
            $categoryService->updateCategory($category, $request);

            return redirect()->route('admin.category.index', $category)->with('success', 'Category modified.');
        } catch (\Exception $e) {
            return redirect()->route('admin.category.edit', $category)->with('error', 'Error');
        }
    }

    public function delete(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.category.index')->with('success', 'Category deleted !');
    }

}
