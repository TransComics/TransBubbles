<?php

class LanguagesTableSeeder extends Seeder {
    
    public function run () {
        DB::table('languages')->insert([
            [
                'id' => 'EN',
                'label' => 'English',
            ],
            [
                'id' => 'FR',
                'label' => 'Français',
            ],
            [
                'id' => 'DE',
                'label' => 'German',
            ]
        ]);
    }
}