<?php

namespace App\Creators;

use App\Http\Requests\StoreUserRequest;
use App\Repositories\Users\User as modelRepository;
use Illuminate\Support\Facades\DB;

class BaseCreator
{
    /**
     * Tries to store a user. If is not successful then it rolls back the changes.
     *
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    public function storeModel(array $data)
    {
        try {
            DB::beginTransaction();
            $user = $this->modelRepository->setTemplate($data)->storeModel();
            DB::commit();
        }catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Something went wrong');
        }

        return $user;
    }

    /**
     * @param int $userId
     * @param StoreUserRequest $request
     * @return \App\Models\User|modelRepository
     * @throws \Exception
     */
    public function updateByReference(int $userId, array $data)
    {
        try {
            DB::beginTransaction();
            $user = $this->modelRepository->updateByReference($userId, $data);
            DB::commit();
        }catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('The user was not updated');
        }

        return $user;
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
            $result = $this->modelRepository->destroyModel($modelId);
            DB::commit();
        }catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('The model was not deleted.');
        }

        return $result;
    }

}
