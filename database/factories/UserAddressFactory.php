<?php

namespace Database\Factories;

use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'comments'=>$this->faker->text,
            'postcode'=>'NR13AD',
            'building_name'=>$this->faker->domainName,
            'street' => $this->faker->streetName,
            'number' =>rand(1,100)
        ];
    }
}
