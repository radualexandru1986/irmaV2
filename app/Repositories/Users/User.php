<?php

namespace App\Repositories\Users;

use App\Repositories\BaseRepository;
use App\Contracts\Repositories\Users\User as UserInterface;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Hash;

class User extends BaseRepository implements UserInterface
{
    /**
     * Creates a new instance of the model
     *
     * @param UserModel $model
     */
    public function __construct(UserModel $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $data
     * @return User
     */
    public function setTemplate(array $data): User
    {
        $this->modelTemplate = [
            'role_id' => $data['role_id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'telephone' => $data['telephone'],
            'password' => Hash::make($data['password'])
        ];

        return $this;
    }


}
