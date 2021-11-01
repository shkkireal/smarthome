<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('room_names')->insert([
            'name' => 'Тамбур'
        ]);
        DB::table('room_names')->insert([
            'name' => 'Гостинная'
        ]);

        DB::table('room_names')->insert([
            'name' => 'Столовая'
        ]);
        DB::table('room_names')->insert([
            'name' => 'Кухня'
        ]);

    }
}
