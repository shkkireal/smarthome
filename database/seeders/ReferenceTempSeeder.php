<?php

namespace Database\Seeders;

use App\Models\ReferenceTemp;
use Illuminate\Database\Seeder;

class ReferenceTempSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ReferenceTemp::factory()
            ->count(50)
            ->create();
    }
}
