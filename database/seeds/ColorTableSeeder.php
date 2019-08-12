<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('colors')->truncate();
        DB::table('colors')->insert([
            ['name' => 'Green', 'value' => '#00ff00'],
            ['name' => 'Red', 'value' => '#ff0000'],
            ['name' => 'Yellow', 'value' => '#ffff00'],
        ]);
    }
}
