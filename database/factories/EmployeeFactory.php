<?php

namespace Database\Factories;

use App\Models\Contract;
use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'contract_id'=>rand(1,3),
            'department_id'=>rand(1,4),
            'user_id'=>User::factory(),
        ];
    }
}
