<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function home()
    {
        return view("admin.home");
    }

    public function addCategory()
    {
        return view("admin.addcategory");
    }

    public function categories()
    {
        return view("admin.categories");
    }

    public function addSlider()
    {
        return view("admin.addSlider");
    }

    public function sliders()
    {
        return view("admin.sliders");
    }
}
