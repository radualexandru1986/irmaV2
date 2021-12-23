<?php

namespace App\Creators\Users;

use App\Creators\BaseCreator;
use App\Contracts\Repositories\Users\User as ModelRepository;

class User extends BaseCreator
{
    /**
     * @var ModelRepository
     */
    protected ModelRepository $modelRepository;

    /**
     * @param ModelRepository $user
     */
    public function __construct(ModelRepository $userRepository)
    {
        $this->modelRepository = $userRepository;
    }

}
