<?php

namespace App\Creators\Containers;

use App\Creators\BaseCreator;
use App\Contracts\Repositories\Containers\Container as ContainerModel;

class Container extends BaseCreator
{

    /**
     * @param \App\Models\Container $container
     */
    public function __construct(ContainerModel $container)
    {
        $this->modelRepository = $container;
    }

}
