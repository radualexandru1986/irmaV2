<?php

namespace App\Creators\Contracts;

use App\Creators\BaseCreator;
use  App\Contracts\Repositories\Contracts\Contract as ContractRepository;

class Contract extends BaseCreator
{
    /**
     * @param ContractRepository $contract
     */
        public function __construct(ContractRepository $contract)
        {
            $this->modelRepository = $contract;
        }
}
