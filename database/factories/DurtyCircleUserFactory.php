<?php

namespace Database\Factories;

use App\Models\DurtyCircleUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class DurtyCircleUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DurtyCircleUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
             'WorkOnCircle' => 5,
             'room_id' => $this->faker->unique()->randomElement([1,2,3,4]),
        ];
    }
}
