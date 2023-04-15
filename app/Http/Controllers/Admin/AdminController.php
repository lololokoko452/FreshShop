<?php

namespace App\Http\Controllers\Admin;

class AdminController extends Controller
{
    public function home()
    {
        return view("admin.home");
    }
}
