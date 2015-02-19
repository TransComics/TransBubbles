<?php

class LanguagesTableSeeder extends Seeder {
    
    public function run () {
        DB::table('languages')->insert([
            [
                'id'        => 1,
                'shortcode' => 'en',
                'codeiso' => 'eng',
                'code'      => 'en-UK',
                'label' => 'English',
            ],
            [
                'id'        => 2,
                'shortcode' => 'fr',
                'codeiso' => 'fra',
                'code'      => 'fr-FR',
                'label' => 'Français',
            ],
            [
                'id'        => 3,
                'shortcode' => 'de',
                'codeiso' => 'deu',
                'code'      => 'de-DE',
                'label' => 'German',
            ]
        ]);
    }
}