<?php

namespace Database\Factories;

use App\Models\Temp;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class TempFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Temp::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'updated_at' =>$this->faker->dateTimeBetween('-1 Hour', Carbon::now()),
            //'T1' => $this->faker->randomNumber(2),
            'T1' => 10,
            'T2' => $this->faker->randomNumber(2),
            'H1' => $this->faker->randomNumber(2),
            'H2' => $this->faker->randomNumber(2),
            'T_pola_1' => $this->faker->randomNumber(2),
            'PPM' => $this->faker->randomNumber(2)
        ];




    }
}
