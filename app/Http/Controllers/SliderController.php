<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\SliderRequest;
use App\Models\Slider;
use App\Services\Admin\SliderService;
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

    public function store(SliderRequest $request, SliderService $sliderService)
    {
        try {
            $sliderService->saveNewSlider($request);

            return redirect()->route('admin.slider.index')->with('success', 'Slider created successfuly');
        } catch (\Exception $e) {
            return redirect()->route('admin.slider.new')->with('error', 'Error');
        }
    }
}
