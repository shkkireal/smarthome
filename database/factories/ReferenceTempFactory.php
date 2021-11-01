<?php

namespace Database\Factories;

use App\Models\ReferenceTemp;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReferenceTempFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ReferenceTemp::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
                'CityInTemp' => $this->faker->randomNumber(2),
                'CityOutTemp' => $this->faker->randomNumber(2),
                'FloorInTemp' => 27,
                'FloorOutTemp' => $this->faker->randomNumber(2)
        ];
    }
}
