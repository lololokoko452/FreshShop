<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\SliderRequest;
use App\Models\Slider;

class SliderService extends AdminService
{
    public function saveNewSlider(SliderRequest $request)
    {
        $validatedData = $request->validated();
        $fileNameWithExt = $request->file('image')->getClientOriginalName();
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        $ext = $request->file('image')->getClientOriginalExtension();
        $validatedData['imageName'] = $fileName . "_" . time() . "." . $ext;

        // Move the uploaded file to the storage directory
        $request->file('image')->move(storage_path('app/public/slider_images'), $validatedData['imageName']);

        return $this->create(Slider::class, $validatedData);
    }


    public function updateSlider(Slider $slider, SliderRequest $request)
    {
        return $this->update($slider, $request->validated());
    }
}
