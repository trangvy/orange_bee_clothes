<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('sizes')->truncate();
        DB::table('sizes')->insert([
            ['name' => 'X', 'value' => ''],
            ['name' => 'S', 'value' => ''],
            ['name' => 'M', 'value' => ''],
        ]);
    }
}
