<?php

namespace App\Repositories\Departments;
use App\Contracts\Repositories\Departments\Department as DepartmentInterface;
use App\Repositories\BaseRepository;
use App\Models\Department as DepartmentModel;


class Department extends BaseRepository implements DepartmentInterface
{
    /**
     * @param DepartmentModel $model
     */
    public function __construct(DepartmentModel $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $data
     * @return Department
     */
    public function setTemplate(array $data): Department
    {
        $this->modelTemplate = [
            'name' => $data['name'],
            'description' => $data['description']
        ];

        return $this;
    }
}
