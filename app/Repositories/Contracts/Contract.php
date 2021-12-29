<?php

namespace App\Repositories\Contracts;

use App\Repositories\BaseRepository;
use App\Contracts\Repositories\Contracts\Contract as ContractInterface;
use App\Models\Contract as ContractModel;

class Contract extends BaseRepository implements ContractInterface
{
    /**
     * @param ContractModel $model
     */
    public function __construct(ContractModel $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setTemplate(array $data): Contract
    {
        $this->modelTemplate = [
            'name' => $data['name'],
            'hours' => $data['hours']
        ];
        return $this;
    }
}
