<?php

class ComicsTableSeeder extends Seeder {
    
    public function run () {
        Comic::unguard();
        
        Comic::create([
            'id' => 1,
            'title' => 'Strumph',
            'author' => 'AMC',
            'description' => 'Description Strumph',
            'authorApproval' => true,
            'cover' => '/uploads/0/ce7afa9115bb0b891963c632be0c4696',
            'font_id' => 2,
            'created_by' => 2,
            'lang_id' => 2
        ]);
        Comic::create([
            'id' => 2,
            'title' => 'Spiderman II',
            'author' => 'gbergereI',
            'description' => 'Description SII',
            'authorApproval' => true,
            'cover' => '/uploads/0/d9480b185525aa7711522b34544fb0f6',
            'font_id' => 3,
            'created_by' => 3,
            'lang_id' => 1
        ]);
        Comic::create([
            'id' => 3,
            'title' => 'Gallows Humor - Chapter 1',
            'author' => 'Valerie, Rachel and Sab',
            'description' => 'Gallows Humor Comics, it’s as if slice of life, fantasy, and history had a hideous mutant baby all rolled into one ridiculous comic strip. Upon encountering the God of Death, Thanatos, ditzy mortal Alma finds herself between two worlds. Between battling Thanatos for the T.V. remote and fending off the forces of vengeful Gods Alma isn’t quite sure which situation she would rather be stuck in…but it seems like she will be getting a lot of both!<br />
<br />
The story of Gallows Humor Comics is written and illustrated by Valerie and Rachel (chapters 1-4 & half of 5 written by Sab)<br />
<br />
Contact us here: GallowsHumor_Comics@yahoo.com<br />
Yahoo Messenger: gallowshumor_comics',
            'authorApproval' => true,
            'cover' => '/uploads/0/e8a9e3fd0e4085fb2385a56f83451420',
            'font_id' => 4,
            'created_by' => 2,
            'lang_id' => 1,
            'created_at' => '2015-02-17 14:43:35'
        ]);
    }
}

?>
