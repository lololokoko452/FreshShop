<?php

namespace App\Services\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AdminService
{
    /**
     * @param Model $model
     * @param Collection $validatedRequest
     * @return Model
     */
    public function update(Model $model, array $validatedRequest): Model
    {
        $model->update($validatedRequest);

        return $model;
    }

    /**
     * @param string $modelClass
     * @param array $validatedRequest
     * @return Model
     */
    public function create(string $modelClass, array $validatedRequest): Model
    {
        $model = new $modelClass;
        $model->fill($validatedRequest);

        try {
            $model->save();
        } catch (\Exception $e) {
            Log::error('Error creating new record: ' . $e->getMessage());
            throw new \Exception('Error creating new record', 500);
        }

        return $model;
    }

}
