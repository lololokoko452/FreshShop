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
}
