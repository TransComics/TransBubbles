<?php

class ComicsTableSeeder extends Seeder {

    public function run() {
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
            'created_at' => '2015-02-17 14:43:35',
            'validated_by' => '5',
            'validated_at' => '2015-02-20 12:07:24',
            'validated_state' => 'VALIDATED'
        ]);

        Comic::create([
            'id' => 4,
            'title' => 'Gallows Humor - Chapter 2',
            'author' => 'Valerie, Rachel and Sab',
            'description' => "Gallows Humor Comics, it’s as if slice of life, fantasy, and history had a hideous mutant baby all rolled into one ridiculous comic strip. Upon encountering the God of Death, Thanatos, ditzy mortal Alma finds herself between two worlds. Between battling Thanatos for the T.V. remote and fending off the forces of vengeful Gods Alma isn’t quite sure which situation she would rather be stuck in…but it seems like she will be getting a lot of both!<br />\n<br />\nThe story of Gallows Humor Comics is written and illustrated by Valerie and Rachel (chapters 1-4 & half of 5 written by Sab)<br />\n<br />\nContact us here: GallowsHumor_Comics@yahoo.com<br />\nYahoo Messenger: gallowshumor_comics",
            'authorApproval' => true,
            'cover' => '/uploads/0/c856368d7f87c092bf42dc9ab2196806',
            'font_id' => 5,
            'created_by' => 3,
            'lang_id' => 1,
            'created_at' => '2015-02-18 12:05:36',
            'updated_at' => '2015-02-20 12:55:54',
            'validated_by' => 5,
            'validated_at' => '2015-02-20 11:38:14',
            'validated_state' => 'VALIDATED',
        ]);

        Comic::create([
            'id' => '5',
            'title' => 'Cyanide & Happiness',
            'author' => 'Rob DenBleyker, Kris Wilson, Dave McElfatrick and Matt Melvin',
            'description' => 'Cyanide & Happiness is a webcomic written and illustrated by Rob DenBleyker, Kris Wilson, Dave McElfatrick and formerly Matt Melvin. It is published on their website explosm.net. It was created on December 9, 2004, and started running daily on January 26, 2005. It has appeared on social networking sites such as Myspace, Quora, LiveJournal, and Facebook, where, in April 2006, it had generated more than a million visits per week. The comic\'s authors attribute its success to its often controversial nature. Cyanide & Happiness characters were used in the television advertisements for Orange Mobile\'s Orange Wednesdays.',
            'authorApproval' => '1',
            'cover' => '/uploads/0/986276103dc54199b548f317b267c683',
            'font_id' => '5',
            'created_by' => '1',
            'lang_id' => '1',
            'created_at' => '2015-02-20 11:39:08',
            'updated_at' => '2015-02-20 12:07:24',
            'validated_by' => '5',
            'validated_at' => '2015-02-20 12:07:24',
            'validated_state' => 'VALIDATED'
        ]);

        Comic::create([
            'id' => '6',
            'title' => 'Glory Owl',
            'author' => 'Glory Owl',
            'description' => 'http://gloryowlcomix.blogspot.fr/',
            'authorApproval' => '1',
            'cover' => '/uploads/0/d2ea1c104875bd05fc9cd8173dc72f9c',
            'font_id' => '1',
            'created_by' => '4',
            'lang_id' => '2',
            'created_at' => '2015-02-20 12:50:53',
            'updated_at' => '2015-02-20 13:32:13',
            'validated_by' => '5',
            'validated_at' => '2015-02-20 13:32:13',
            'validated_state' => 'REFUSED',
            'validated_comments' => 'Description pas assez parlante',
        ]);

        Comic::create([
            'id' => '7',
            'title' => 'XKCD',
            'author' => 'Randall Munroe',
            'description' => 'http://xkcd.com',
            'authorApproval' => '1',
            'cover' => '/uploads/2/0f48fdab00575b7060b03e96c1e46f5a',
            'font_id' => '5',
            'created_by' => '6',
            'lang_id' => '1',
            'created_at' => '2015-02-20 14:42:43',
            'updated_at' => '2015-02-20 14:43:52',
            'validated_by' => NULL,
            'validated_at' => NULL,
            'validated_state' => 'PENDING',
            'validated_comments' => NULL,
        ]);
    }

}

?>
