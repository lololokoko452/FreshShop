<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\SliderRequest;
use App\Models\Slider;
use App\Services\Admin\SliderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();

        return view("admin.slider.index", compact("sliders"));
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

    public function update(SliderRequest $request, SliderService $sliderService, Slider $slider): RedirectResponse
    {
        try {
            $sliderService->updateSlider($request, $slider);

            return redirect()->route('admin.slider.index', $slider)->with('success', 'Slider modified.');
        } catch (\Exception $e) {
            return redirect()->route('admin.slider.edit', $slider)->with('error', 'Error');
        }
    }

    public function delete(Slider $slider)
    {
        Storage::delete("public/slider_images/$slider->imageName");
        $slider->delete();
        return redirect()->route('admin.slider.index')->with('success', 'Slider deleted !');
    }

    public function status(Slider $slider, SliderService $sliderService)
    {
        $sliderService->updateStatus($slider);
        if ($slider->status){
            return redirect()->route('admin.slider.index', $slider)->with('success', 'Status activated.');
        } else {
            return redirect()->route('admin.slider.index', $slider)->with('success', 'Status unactivated.');
        }
    }
}
