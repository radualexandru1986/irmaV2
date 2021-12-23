<?php

namespace App\Creators;
use Illuminate\Support\Facades\DB;

class BaseCreator
{

    protected $model;
    /**
     *
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    public function storeModel(array $data)
    {
        try {
            DB::beginTransaction();
            $model = $this->model->setTemplate($data)->storeModel();
            DB::commit();
        }catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Something went wrong in the Creator');
        }

        return $model;
    }

    /**
     * @param int $modelId
     * @param array $data
     * @throws \Exception
     */
    public function updateByReference(int $modelId, array $data)
    {
        try {
            DB::beginTransaction();
            $model = $this->model->updateByReference($modelId, $data);
            DB::commit();
        }catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('The user was not updated');
        }

        return $model;
    }

    /**
     * @param int $modelId
     * @return bool
     * @throws \Exception
     */
    public function destroyModel(int $modelId)
    {
        try {
            DB::beginTransaction();
            $result = $this->model->destroyModel($modelId);
            DB::commit();
        }catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('The model was not deleted.');
        }

        return $result;
    }

}
