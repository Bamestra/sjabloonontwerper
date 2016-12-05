<?php

use Illuminate\Database\Seeder;

class OnderdeelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('onderdeel')->insert([
            'sjabloon_id' => 1,
            'id' => 1,
            'next_id' => 2,
            'naam' => 'Testonderdeel 1',
            'soort' => '1',
        ]);
        
        DB::table('onderdeel')->insert([
            'sjabloon_id' => 1,
            'id' => 2,
            'prev_id' => 1,
            'naam' => 'Testonderdeel 2',
            'soort' => '1',
        ]);
        
        DB::table('onderdeel')->insert([
            'sjabloon_id' => 1,
            'id' => 3,
            'parent_id' => 1,
            'next_id' => 4,
            'naam' => 'Testonderdeel 3',
            'soort' => '1',
        ]);
        
        DB::table('onderdeel')->insert([
            'sjabloon_id' => 1,
            'id' => 4,
            'parent_id' => 1,
            'prev_id' => 3,
            'naam' => 'Testonderdeel 4',
            'soort' => '1',
        ]);
    }
}
