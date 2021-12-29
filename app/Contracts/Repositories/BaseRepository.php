<?php

namespace App\Contracts\Repositories;

use Illuminate\Support\Collection;

interface BaseRepository
{
    /**
     * @return mixed
     */
    function all(): Collection;

    function storeModel();

    function updateByReference(int $id, array $data);

    function destroyModel(int $id);

    function setTemplate(array $data);

}
