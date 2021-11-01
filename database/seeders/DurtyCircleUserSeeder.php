<?php

namespace Database\Seeders;


use App\Models\DurtyCircleUser;
use Illuminate\Database\Seeder;

class DurtyCircleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DurtyCircleUser::factory()
            ->count(4)
            ->create();
    }
}
