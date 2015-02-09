<?php

class StripSeeder extends Seeder {

    public function run () {
        DB::table('strips')->insert([
            [
                'title' => 'Tintin',
                'path' => '/usr/books/tintin/page1.png',
                'pageNumber' => 1,
            ],
            [
                'title' => 'Tintin',
                'path' => '/usr/books/tintin/page2.png',
                'pageNumber' => 2,
            ]
        ]);
    }
}
