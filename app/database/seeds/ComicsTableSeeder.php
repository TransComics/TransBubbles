<?php

class ComicsTableSeeder extends Seeder {
    
    public function run () {
        DB::table('comics')->insert([
            [
                'title' => 'Strumph',
                'author' => 'AMC',
                'description' => 'Description Strumph',
                'authorApproval' => true,
                'cover' => '/images/comics/0/ce7afa9115bb0b891963c632be0c4696',
            ],
            [
                'title' => 'Spiderman II',
                'author' => 'gbergereI',
                'description' => 'Description SII',
                'authorApproval' => true,
                'cover' => '/images/comics/0/d9480b185525aa7711522b34544fb0f6',
            ]
        ]);
    }
}