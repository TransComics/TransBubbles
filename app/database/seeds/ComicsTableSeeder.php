<?php

class ComicsTableSeeder extends Seeder {
    
    public function run () {
        Comic::unguard();
        
        Comic::create([
            'id' => 3,
            'title' => 'Gallows Humor - Chapter 1',
            'author' => 'Valerie, Rachel and Sab',
            'description' => "Gallows Humor Comics, it’s as if slice of life, fantasy, and history had a hideous mutant baby all rolled into one ridiculous comic strip. Upon encountering the God of Death, Thanatos, ditzy mortal Alma finds herself between two worlds. Between battling Thanatos for the T.V. remote and fending off the forces of vengeful Gods Alma isn’t quite sure which situation she would rather be stuck in…but it seems like she will be getting a lot of both!<br />\n<br />\nThe story of Gallows Humor Comics is written and illustrated by Valerie and Rachel (chapters 1-4 & half of 5 written by Sab)<br />\n<br />\nContact us here: GallowsHumor_Comics@yahoo.com<br />\nYahoo Messenger: gallowshumor_comics",
            'authorApproval' => true,
            'cover' => '/uploads/0/e8a9e3fd0e4085fb2385a56f83451420',
            'font_id' => 4,
            'created_by' => 2,
            'lang_id' => 1,
            'created_at' => '2015-02-17 14:43:35'
        ]);
        
        Comic::create([
            'id' => 4,
            'title' => 'Gallows Humor - Chapter 2',
            'author' => 'Valerie, Rachel and Sab',
            'description' => "Gallows Humor Comics, it’s as if slice of life, fantasy, and history had a hideous mutant baby all rolled into one ridiculous comic strip. Upon encountering the God of Death, Thanatos, ditzy mortal Alma finds herself between two worlds. Between battling Thanatos for the T.V. remote and fending off the forces of vengeful Gods Alma isn’t quite sure which situation she would rather be stuck in…but it seems like she will be getting a lot of both!<br />\n<br />\nThe story of Gallows Humor Comics is written and illustrated by Valerie and Rachel (chapters 1-4 & half of 5 written by Sab)<br />\n<br />\nContact us here: GallowsHumor_Comics@yahoo.com<br />\nYahoo Messenger: gallowshumor_comics",
            'authorApproval' => true,
            'cover' => '/uploads/0/c856368d7f87c092bf42dc9ab2196806',
            'font_id' => 1,
            'created_by' => 3,
            'lang_id' => 1,
            'created_at' => '2015-02-18 12:05:36',
        ]);
    }
}

?>
