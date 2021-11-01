<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
       $this->call(TempSeeder::class);
        $this->call(TermoHeadSeeder::class);
        $this->call(DutyCycleSeeder::class);
        $this->call(RoomNameSeeder::class);
        $this->call(DurtyCircleUserSeeder::class);
        $this->call(ReferenceTempSeeder::class);
        $this->call(SystemHeatingJobSeeder::class);

    }
}
