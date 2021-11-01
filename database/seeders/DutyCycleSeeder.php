<?php

namespace Database\Seeders;

use App\Models\DutyCycle;
use Illuminate\Database\Seeder;

class DutyCycleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DutyCycle::factory()
            ->count(4)
            ->create();
    }
}
