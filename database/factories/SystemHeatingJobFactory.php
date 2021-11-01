<?php

namespace Database\Factories;

use App\Models\SystemHeatingJob;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class SystemHeatingJobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SystemHeatingJob::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
                       'updated_at' =>$this->faker->dateTimeBetween('-3 Hour', Carbon::now()),
            'SystemNowHeating' =>$this->faker->randomElement([true,false]),
            'RoomNeedHeating'  =>$this->faker->randomElement([true,false])
        ];
    }
}
