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
            'parent_id' => 0,
            'volgorde' => 1,
            'naam' => 'Testpagina 1',
            'soort' => 1,
        ]);
        
        DB::table('onderdeel')->insert([
            'sjabloon_id' => 1,
            'id' => 2,
            'parent_id' => 0,
            'volgorde' => 2,
            'naam' => 'Testpagina 2',
            'soort' => 1,
        ]);
        
        DB::table('onderdeel')->insert([
            'sjabloon_id' => 1,
            'id' => 3,
            'parent_id' => 2,
            'volgorde' => 1,
            'naam' => 'Testonderdeel 1',
            'soort' => 2,
        ]);
        
        DB::table('onderdeel')->insert([
            'sjabloon_id' => 1,
            'id' => 4,
            'parent_id' => 2,
            'volgorde' => 2,
            'naam' => 'Testonderdeel 2',
            'soort' => 2,
        ]);
        
        DB::table('onderdeel')->insert([
            'sjabloon_id' => 1,
            'id' => 5,
            'parent_id' => 2,
            'volgorde' => 3,
            'naam' => 'Testonderdeel 3',
            'soort' => 2,
        ]);
    }
}
