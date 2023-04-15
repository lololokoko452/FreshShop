<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\SliderRequest;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

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


    public function updateSlider(SliderRequest $request, Slider $slider)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $ext = $request->file('image')->getClientOriginalExtension();
            $validatedData['imageName'] = $fileName . "_" . time() . "." . $ext;

            // Déplacer le fichier téléchargé vers le répertoire de stockage
            $request->file('image')->move(storage_path('app/public/slider_images'), $validatedData['imageName']);

            // Supprimer l'ancienne image si elle existe
            if (Storage::exists('public/slider_images/' . $slider->imageName)) {
                Storage::delete('public/slider_images/' . $slider->imageName);
            }
        }

        return $this->update($slider, $validatedData);
    }
}
