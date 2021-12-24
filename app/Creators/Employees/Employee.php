<?php

namespace App\Creators\Employees;

use App\Creators\BaseCreator;
use App\Contracts\Repositories\Employees\Employee as ModelRepository;

class Employee extends BaseCreator
{
    /**
     * @param ModelRepository $employee
     */
    public function __construct(ModelRepository $employee)
    {
        $this->modelRepository = $employee;
    }
}
