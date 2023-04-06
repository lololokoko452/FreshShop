<?php

namespace App\Services\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class AdminService
{
    /**
     * @param Model $model
     * @param Collection $validatedRequest
     * @return Model
     */
    /*public function update(Model $model, Collection $validatedRequest): Model
    {
        if ($validatedRequest->has('zipcode') && empty($validatedRequest->get('zipcode'))) {
            $validatedRequest->put('city', null);
        }
        if ($validatedRequest->has('licence_zipcode') && empty($validatedRequest->get('licence_zipcode'))) {
            $validatedRequest->put('licence_city', null);
        }
        $model->update($validatedRequest->toArray());

        return $model;
    }*/

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
