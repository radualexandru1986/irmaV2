<?php

namespace App\Repositories;

use App\Contracts\Repositories\BaseRepository as BaseRepoInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class BaseRepository implements BaseRepoInterface
{
    protected Model $model;
    protected array $modelTemplate;

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * Stores a model in the database
     *
     * @param array $data
     */
    function storeModel(): mixed
    {
        return  $this->model->create($this->modelTemplate);
    }

    /**
     * @param int $modelId
     * @param array $data
     * @return $this
     */
    function updateByReference(int $modelId, array $data):mixed
    {
        $updatedModel = $this->model->findOrFail($modelId);
        $updatedModel->update($data);
        return $updatedModel;
    }

    /**
     * @param int $modelId
     * @return bool
     */
    function destroyModel(int $modelId): bool
    {
        return $this->model->destroy($modelId);
    }

}
