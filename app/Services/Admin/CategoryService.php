<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryService extends AdminService
{ 
    public function saveNewCategory(CategoryRequest $request)
    {
        $validatedData = $request->validated();

        $fileNameWithExt = $request->file('image')->getClientOriginalName();
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        $ext = $request->file('image')->getClientOriginalExtension();
        $validatedData['imageName'] = $fileName . "_" . time() . "." . $ext;

        // Move the uploaded file to the storage directory
        $request->file('image')->move(storage_path('app/public/category_images'), $validatedData['imageName']);

        return $this->create(Category::class, $validatedData);
    }

    public function updateCategory(Category $category, CategoryRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $ext = $request->file('image')->getClientOriginalExtension();
            $validatedData['imageName'] = $fileName . "_" . time() . "." . $ext;

            // Déplacer le fichier téléchargé vers le répertoire de stockage
            $request->file('image')->move(storage_path('app/public/category_images'), $validatedData['imageName']);

            // Supprimer l'ancienne image si elle existe
            if (Storage::exists('public/category_images/' . $category->imageName)) {
                Storage::delete('public/category_images/' . $category->imageName);
            }
        }

        return $this->update($category, $validatedData);
    }
}
