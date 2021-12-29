<?php

namespace App\Creators\Shifts;

use App\Contracts\Repositories\Shifts\Shift as ModelRepository;
use App\Creators\BaseCreator;

class Shift extends BaseCreator
{
    /**
     * @param Shift $shift
     */
    public function __construct(ModelRepository $shift)
    {
        $this->modelRepository = $shift;
    }
}
