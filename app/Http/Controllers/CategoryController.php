<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\CategoryRequest;
use App\Services\Admin\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

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

    public function store(CategoryRequest $request, CategoryService $categoryService): View
    {
        $categoryService->saveNewCategory($request);
        return view("admin.category.index");
    }
}
