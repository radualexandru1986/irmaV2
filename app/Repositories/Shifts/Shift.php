<?php

namespace App\Repositories\Shifts;

use App\Repositories\BaseRepository;
use App\Models\Shift as ShiftModel;
use App\Contracts\Repositories\Shifts\Shift as ShiftInterface;

class Shift extends BaseRepository implements ShiftInterface
{

    /**
     * @param ShiftModel $shift
     */
    public function __construct(ShiftModel $shift)
    {
        $this->model = $shift;
    }

    /**
     * @param array $data
     */
    function setTemplate(array $data): Shift
    {
        $this->modelTemplate = [
            'name' => $data['name'],
            'hours' => $data['hours'],
            'department_id' => $data['department_id'],
            'index' => data_get($data, 'index')
        ];

        return $this;
    }
}
