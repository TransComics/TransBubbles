<?php

class FontsTableSeeder extends Seeder {
    
    public function run () {
        DB::table('fonts')->insert([
            ['name' => 'Arial Black'],
            ['name' => 'Calibri'],
            ['name' => 'Calibri Light'],
            ['name' => 'Cambria'],
            ['name' => 'Comics Sans Ms'],
            ['name' => 'Time New Roman'],
            ['name' => 'Trebuchet'],
            ['name' => 'Verdana'],
        ]);
    }
}