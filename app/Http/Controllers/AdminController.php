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
        return view("admin.addCategory");
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

    public function addProduct()
    {
        return view("admin.addProduct");
    }

    public function products()
    {
        return view("admin.products");
    }

    public function orders()
    {
        return view("admin.orders");
    }
}
