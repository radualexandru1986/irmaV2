<?php

namespace App\Creators;

use Exception;
use Illuminate\Support\Facades\DB;

class BaseCreator
{

    protected $modelRepository;

    /**
     *
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    public function storeModel(array $data)
    {
        try {
            DB::beginTransaction();
            $model = $this->modelRepository->setTemplate($data)->storeModel();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Something went wrong in the Creator');
        }

        return $model;
    }

    /**
     * @param int $modelId
     * @param array $data
     * @throws Exception
     */
    public function updateByReference(int $modelId, array $data)
    {
        try {
            DB::beginTransaction();
            $model = $this->modelRepository->updateByReference($modelId, $data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('The user was not updated');
        }

        return $model;
    }

    /**
     * @param int $modelId
     * @return bool
     * @throws Exception
     */
    public function destroyModel(int $modelId)
    {
        try {
            DB::beginTransaction();
            $result = $this->modelRepository->destroyModel($modelId);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('The model was not deleted.');
        }

        return $result;
    }

}
