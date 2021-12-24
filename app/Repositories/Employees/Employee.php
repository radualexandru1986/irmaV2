<?php

namespace App\Repositories\Employees;

use App\Repositories\BaseRepository;
use App\Contracts\Repositories\Employees\Employee as EmployeeInterface;

class Employee extends BaseRepository implements EmployeeInterface
{

    /**
     * @param \App\Models\Employee $employee
     */
    public function __construct(\App\Models\Employee $employee)
    {
        $this->model = $employee;
    }

    /**
     * @param array $data
     * @return $this
     */
    function setTemplate(array $data): Employee
    {
        $this->modelTemplate = [
            'user_id' => $data['user_id'],
            'department_id' => $data['department_id'],
            'contract_id' => $data['contract_id']
        ];
        return $this;
    }
}
