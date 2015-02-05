<?php

class StripSeeder extends Seeder {

    public function run () {
        DB::table('strips')->insert([
            [
                'title' => 'Tintin',
                'path' => '/usr/books/tintin/page1.png',
                'page' => 1,
            ],
            [
                'title' => 'Tintin',
                'path' => '/usr/books/tintin/page2.png',
                'page' => 2,
            ]
        ]);
    }
}
