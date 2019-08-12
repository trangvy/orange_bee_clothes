<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('brands')->truncate();
        DB::table('brands')->insert([
            ['name' => 'Zara'],
            ['name' => 'H&M'],
            ['name' => 'Forever21'],
        ]);
    }
}
