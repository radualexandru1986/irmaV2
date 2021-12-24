<?php

namespace App\Creators\Departments;

use App\Creators\BaseCreator;
use App\Contracts\Repositories\Departments\Department as ModelRepository;

class Department extends BaseCreator
{
    /**
     * @param ModelRepository $department
     */
    public function __construct(ModelRepository $department)
    {
        $this->modelRepository = $department;
    }

}
