<?php

class PopularitiesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('popularities')->insert([
				'vote_up' => 0,
				'vote_down' => 0,
				'strip_id' => 4
        ]);
        DB::table('popularities')->insert([
				'vote_up' => 0,
				'vote_down' => 0,
				'strip_id' => 5
        ]);
        DB::table('popularities')->insert([
				'vote_up' => 0,
				'vote_down' => 0,
				'strip_id' => 10
        ]);
        DB::table('popularities')->insert([
				'vote_up' => 0,
				'vote_down' => 0,
				'strip_id' => 13
        ]);
        DB::table('popularities')->insert([
				'vote_up' => 0,
				'vote_down' => 0,
				'strip_id' => 14
        ]);
        DB::table('popularities')->insert([
				'vote_up' => 0,
				'vote_down' => 0,
				'strip_id' => 15
        ]);
        DB::table('popularities')->insert([
				'vote_up' => 0,
				'vote_down' => 0,
				'strip_id' => 16
        ]);
        DB::table('popularities')->insert([
				'vote_up' => 0,
				'vote_down' => 0,
				'strip_id' => 17 
        ]);
        
        DB::table('popularities')->insert([
				'vote_up' => 0,
				'vote_down' => 0,
				'strip_id' => 18
        ]);
        DB::table('popularities')->insert([
				'vote_up' => 0,
				'vote_down' => 0,
				'strip_id' => 19
        ]);
        DB::table('popularities')->insert([
				'vote_up' => 0,
				'vote_down' => 0,
				'strip_id' => 33
        ]);
        
        DB::table('popularities')->insert([
				'vote_up' => 0,
				'vote_down' => 0,
				'strip_id' => 34
        ]);
        DB::table('popularities')->insert([
				'vote_up' => 0,
				'vote_down' => 0,
				'strip_id' => 38
        ]);
        
        DB::table('popularities')->insert([
				'vote_up' => 0,
				'vote_down' => 0,
				'strip_id' => 43
        ]);
        
        DB::table('popularities')->insert([
				'vote_up' => 0,
				'vote_down' => 0,
				'strip_id' => 45
        ]);
        
        DB::table('popularities')->insert([
				'vote_up' => 0,
				'vote_down' => 0,
				'strip_id' => 46
        ]);
	}
}