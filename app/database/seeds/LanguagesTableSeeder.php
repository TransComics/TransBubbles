<?php

class LanguagesTableSeeder extends Seeder {
    
    public function run () {
        DB::table('languages')->insert([
            [
                'id'        => 1,
                'shortcode' => 'en',
                'code'      => 'en-UK',
                'label' => 'English',
            ],
            [
                'id'        => 2,
                'shortcode' => 'fr',
                'code'      => 'fr-FR',
                'label' => 'Français',
            ],
            [
                'id'        => 3,
                'shortcode' => 'de',
                'code'      => 'de-DE',
                'label' => 'German',
            ]
        ]);
    }
}