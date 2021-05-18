<?php

namespace Database\Factories;

use App\Models\LocationDetails;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationDetailsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LocationDetails::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return ['location_id'=>1, 'address_line1'=>$this->faker->address, 'postcode'=>$this->faker->postcode, 'telephone'=>$this->faker->phoneNumber];
    }
}
