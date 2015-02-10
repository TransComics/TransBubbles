<?php

class ComicsTableSeeder extends Seeder {
    
    public function run () {
        Comic::unguard();
        
        Comic::create([
            'title' => 'Strumph',
            'author' => 'AMC',
            'description' => 'Description Strumph',
            'authorApproval' => true,
            'cover' => '/uploads/0/ce7afa9115bb0b891963c632be0c4696',
            'font_id' => 2
        ]);
        Comic::create([
            'title' => 'Spiderman II',
            'author' => 'gbergereI',
            'description' => 'Description SII',
            'authorApproval' => true,
            'cover' => '/uploads/0/d9480b185525aa7711522b34544fb0f6',
            'font_id' => 3
        ]);
    }
}

?>
