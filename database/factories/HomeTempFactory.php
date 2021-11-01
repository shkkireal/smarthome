<?php

namespace Database\Factories;

use App\Models\HomeTemp;
use Illuminate\Database\Eloquent\Factories\Factory;

class HomeTempFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HomeTemp::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
                           return [
                           'T1' => $this->faker->randomNumber(2),
                           'T2' => $this->faker->randomNumber(2),
                           'H1' => $this->faker->randomNumber(2),
                           'H2' => $this->faker->randomNumber(2),
                           'T_pola_1' => $this->faker->randomNumber(2),
                           'PPM' => $this->faker->randomNumber(2)
                       ];




    }
}
