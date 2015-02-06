<?php

class FontsTableSeeder extends Seeder {
    
    public function run () {
        DB::table('fonts')->insert([
            [
                'name' => 'Arial',
            ],
            [
                'name' => 'Time New Roman',
            ]
        ]);
    }
}