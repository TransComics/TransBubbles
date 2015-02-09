<?php

class FontsTableSeeder extends Seeder {

    public function run() {
        DB::table('fonts')->insert([
            [
                'id' => 1, 
                'name' => 
                'Arial Black'
            ],
            [
                'id' => 2, 
                'name' => 'Calibri'
            ],
            [
                'id' => 3, 
                'name' => 'Calibri Light'
            ],
            [
                'id' => 4, 
                'name' => 'Cambria'
            ],
            [
                'id' => 5, 
                'name' => 'Comics Sans Ms'
            ],
            [
                'id' => 6, 
                'name' => 'Time New Roman'
            ],
            [
                'id' => 7, 
                'name' => 'Trebuchet'
            ],
            [
                'id' => 8, 
                'name' => 'Verdana'
            ],
        ]);
    }

}
