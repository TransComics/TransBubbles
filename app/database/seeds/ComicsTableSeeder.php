<?php

class ComicsTableSeeder extends Seeder {
    
    public function run () {
        DB::table('comics')->insert([
            [
                'title' => 'Spiderman I',
                'author' => 'gbergere',
                'description' => 'Description SI',
            ],
            [
                'title' => 'Spiderman II',
                'author' => 'gbergereI',
                'description' => 'Description SII',
            ]
        ]);
    }
}