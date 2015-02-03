<?php

class ComicsTableSeeder extends Seeder {
    
    public function run () {
        DB::table('comics')->insert([
            [
                'title' => 'Spiderman I',
                'page' => 1,
            ],
            [
                'title' => 'Spiderman II',
                'page' => 2,
            ]
        ]);
    }
}