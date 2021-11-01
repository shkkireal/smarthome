<?php

namespace Database\Factories;

use App\Models\TermoHead;
use Illuminate\Database\Eloquent\Factories\Factory;

class TermoHeadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TermoHead::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'HeadNomber' => rand(1,4),
            'Status' => rand(0,1)
        ];
    }
}
