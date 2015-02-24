<?php

class FontsTableSeeder extends Seeder {

    public function run() {
        DB::table('fonts')->insert([
            [
                'id' => 1, 
                'name' => 'Arial'
            ],
            [
                'id' => 2, 
                'name' => 'Arial Black'
            ],
            [
                'id' => 3, 
                'name' => 'Helvetica'
            ],
            [
                'id' => 4, 
                'name' => 'Myriad Pro'
            ],
            [
                'id' => 5, 
                'name' => 'Delicious'
            ],
            [
                'id' => 6, 
                'name' => 'Verdana'
            ],
             [
                'id' => 7, 
                'name' => 'Georgia'
            ],
             [
                'id' => 8, 
                'name' => 'Courier'
            ],
             [
                'id' => 9, 
                'name' => 'Comic Sans MS'
            ],
             [
                'id' => 10, 
                'name' => 'Impact'
            ],
            [
                'id' => 11, 
                'name' => 'Monaco'
            ],
            [
                'id' => 12, 
                'name' => 'Optima'
            ],
            [
                'id' => 13, 
                'name' => 'Hoefler Text'
            ],
            [
                'id' => 14, 
                'name' => 'Plaster'
            ],
            [
                'id' => 15, 
                'name' => 'Engagement'
            ],
            [
                'id' => 16, 
                'name' => 'Calibri'
            ],
            [
                'id' => 17, 
                'name' => 'Calibri Light'
            ],
            [
                'id' => 18, 
                'name' => 'Cambria'
            ],
            [
                'id' => 19, 
                'name' => 'Time New Roman'
            ],
            [
                'id' => 20, 
                'name' => 'Trebuchet'
            ],
        ]);
    }

}
