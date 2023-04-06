<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\CategoryRequest;
use App\Services\Admin\CategoryService;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function index()
    {
        return view("admin.category.index");
    }

    public function new()
    {
        return view("admin.category.new");
    }

    public function store(CategoryRequest $request, CategoryService $categoryService)
    {
        try {
            $category = $categoryService->saveNewCategory($request);

            return redirect()->route('admin.category.index')->with('toast_success', 'Nouveau cours créé.');
        } catch (\Exception $e) {
            return redirect()->route('admin.category.new')->with('toast_error', 'Une erreur est survenue');
        }
    }



}
