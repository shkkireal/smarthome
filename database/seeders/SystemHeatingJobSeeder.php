<?php

namespace Database\Seeders;

use App\Models\SystemHeatingJob;
use Illuminate\Database\Seeder;

class SystemHeatingJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      SystemHeatingJob::factory()
          ->count(50)
          ->create();
    }

}
