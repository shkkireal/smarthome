<?php

namespace Database\Seeders;

use App\Models\TermoHead;
use Illuminate\Database\Seeder;

class TermoHeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TermoHead::factory()
            ->count(4)
            ->create();
    }
}
