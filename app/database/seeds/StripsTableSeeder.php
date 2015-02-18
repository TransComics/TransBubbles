<?php

class StripsTableSeeder extends Seeder {

    public function run() {
        Strip::unguard();

        Strip::create([
            'id' => 1,
            'comic_id' => 2,
            'title' => 'Je suis projet',
            'path' => '/uploads/0/363b1c29fe79ecbd4a1777201ce11dee',
            'validated_at' => '2015-02-10 11:12:32',
            'user_id' => 1,
        ]);
        Strip::create([
            'id' => 2,
            'comic_id' => 1,
            'title' => 'Portable du père',
            'path' => '/uploads/0/cdb8a777ccf2c7c539cafe4e670c72e2',
            'user_id' => 2,
        ]);
        Strip::create([
            'id' => 3,
            'comic_id' => 2,
            'title' => 'Devop ?',
            'path' => '/uploads/0/58f19710798ee712be8efaeba131f768',
            'validated_at' => '2015-02-10 11:12:32',
            'user_id' => 4,
        ]);
        
        Strip::create([
            'id' => 4,
            'comic_id' => 3,
            'title' => 'Chapter 1: Page 1',
            'path' => '/uploads/0/5d46295fe2f7127018786ae6185e4412',
            'validated_at' => '2015-02-10 11:12:32',
            'user_id' => 2,
        ]);
        Strip::create([
            'id' => 5,
            'comic_id' => 3,
            'title' => 'Chapter 1: Page 2',
            'path' => '/uploads/0/af83c70e0911c75aca1010a3409d12a3',
            'validated_at' => '2015-02-10 11:12:32',
            'user_id' => 2,
        ]);
        Strip::create([
            'id' => 6,
            'comic_id' => 3,
            'title' => 'Chapter 1: Page 3',
            'path' => '/uploads/0/26ef3aa7f59d0bec5a663053b776c0cd',
            'validated_at' => '2015-02-10 11:12:32',
            'user_id' => 2,
        ]);
        Strip::create([
            'id' => 7,
            'comic_id' => 3,
            'title' => 'Chapter 1: Page 4',
            'path' => '/uploads/0/513a5bb8df3120b04a138efbed15f658',
            'validated_at' => '2015-02-10 11:12:32',
            'user_id' => 2,
        ]);
        Strip::create([
            'id' => 8,
            'comic_id' => 3,
            'title' => 'Chapter 1: Page 5',
            'path' => '/uploads/0/9a1381ff92b12821e0c90185fcc90932',
            'validated_at' => '2015-02-10 11:12:32',
            'user_id' => 2,
        ]);
        Strip::create([
            'id' => 9,
            'comic_id' => 3,
            'title' => 'Chapter 1: Page 6',
            
            'path' => '/uploads/0/65d811bbe303f9cec469566dfad82ca0',
            'validated_at' => '2015-02-10 11:12:32',
            'user_id' => 2,
        ]);
        Strip::create([
            'id' => 10,
            'comic_id' => 3,
            'title' => 'Chapter 1: Page 7',
            'path' => '/uploads/0/a6fb13723e74cb9a6ca86b9862a75691',
            'validated_at' => '2015-02-10 11:12:32',
            'user_id' => 2,
        ]);
        Strip::create([
            'id' => 11,
            'comic_id' => 3,
            'title' => 'Chapter 1: Page 8',
            'path' => '/uploads/0/3da206455ad26d107108752a484a4003',
            'validated_at' => '2015-02-10 11:12:32',
            'user_id' => 2,
        ]);
        Strip::create([
            'id' => 12,
            'comic_id' => 3,
            'title' => 'Chapter 1: Page 9',
            'path' => '/uploads/0/21023a8b83a32fa58d62fbcc2914a5a0',
            'validated_at' => '2015-02-10 11:12:32',
            'user_id' => 2,
        ]);
        Strip::create([
            'id' => 13,
            'comic_id' => 3,
            'title' => 'Chapter 1: Page 10',
            'path' => '/uploads/0/4add9b73d5ab647ee47aebcd0438eb30',
            'validated_at' => '2015-02-10 11:12:32',
            'user_id' => 2,
        ]);
    }

}
