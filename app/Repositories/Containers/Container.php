<?php

namespace App\Repositories\Containers;

use App\Repositories\BaseRepository;
use App\Contracts\Repositories\Containers\Container as ContainersInterface;
use App\Models\Container as ContainerModel;

class Container extends BaseRepository implements ContainersInterface
{

    /**
     * @param ContainerModel $container
     */
    public function __construct(ContainerModel $container)
    {
        $this->model = $container;
    }

    /**
     * @param array $data
     * @return $this
     */
    function setTemplate(array $data): mixed
    {
        $this->modelTemplate = [
            'container_date' => $data['container_date'],
            'rota_id' => $data['rota_id']
        ];

        return $this;
    }
}
