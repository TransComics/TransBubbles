<?php

class LanguagesTableSeeder extends Seeder {
    
    public function run () {
        DB::table('languages')->insert([
            [
                'id' => 'en',
                'label' => 'English',
            ],
            [
                'id' => 'fr',
                'label' => 'Français',
            ],
            [
                'id' => 'de',
                'label' => 'German',
            ]
        ]);
    }
}