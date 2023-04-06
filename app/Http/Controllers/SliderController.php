<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        return view("admin.slider.index");
    }

    public function new()
    {
        return view("admin.slider.new");
    }
}
