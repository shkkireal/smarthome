<?php

namespace Database\Seeders;


use App\Models\DurtyCircleUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

        DB::table('durty_circle_users')->insert([
            'WorkOnCircle' => '5',
            'room_id' => '1'
        ]);
        DB::table('durty_circle_users')->insert([
            'WorkOnCircle' => '5',
            'room_id' => '2'
        ]);
        DB::table('durty_circle_users')->insert([
            'WorkOnCircle' => '5',
            'room_id' => '3'
        ]);
        DB::table('durty_circle_users')->insert([
            'WorkOnCircle' => '5',
            'room_id' => '4'
        ]);

    }
}
