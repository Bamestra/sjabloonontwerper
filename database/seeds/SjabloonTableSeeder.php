<?php

use Illuminate\Database\Seeder;

class SjabloonTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('sjabloon')->insert(['naam' => 'Testsjabloon 1']);
        DB::table('sjabloon')->insert(['naam' => 'Testsjabloon 2']);
        DB::table('sjabloon')->insert(['naam' => 'Testsjabloon 3']);
        DB::table('sjabloon')->insert(['naam' => 'Testsjabloon 4']);
    }

}
