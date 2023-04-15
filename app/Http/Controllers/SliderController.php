<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SliderController extends Controller
{
    public function index()
    {
        return view("admin.slider.index");
    }

    public function form(Slider|null $slider): View
    {
        $formAction = $slider?->id ? route('admin.slider.update', $slider) : route('admin.slider.store');

        return view("admin.slider.form", compact("slider", "formAction"));
    }
}
