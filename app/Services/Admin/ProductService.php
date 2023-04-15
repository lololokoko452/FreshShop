<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductService extends AdminService
{
    public function saveNewProduct(ProductRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData["category_id"] = $request["category_id"];

        $fileNameWithExt = $request->file('image')->getClientOriginalName();
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        $ext = $request->file('image')->getClientOriginalExtension();
        $validatedData['imageName'] = $fileName . "_" . time() . "." . $ext;

        // Move the uploaded file to the storage directory
        $request->file('image')->move(storage_path('app/public/product_images'), $validatedData['imageName']);

        return $this->create(Product::class, $validatedData);
    }


    public function updateProduct(ProductRequest $request, Product $product)
    {
        $validatedData = $request->validated();
        $validatedData["category_id"] = $request["category_id"];

        if ($request->hasFile('image')) {
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $ext = $request->file('image')->getClientOriginalExtension();
            $validatedData['imageName'] = $fileName . "_" . time() . "." . $ext;

            // Déplacer le fichier téléchargé vers le répertoire de stockage
            $request->file('image')->move(storage_path('app/public/product_images'), $validatedData['imageName']);

            // Supprimer l'ancienne image si elle existe
            if (Storage::exists('public/product_images/' . $product->imageName)) {
                Storage::delete('public/product_images/' . $product->imageName);
            }
        }

        return $this->update($product, $validatedData);
    }
}
