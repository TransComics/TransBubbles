<?php

class StripsTableSeeder extends Seeder {

    public function run() {
        Strip::unguard();

        Strip::create([
            'id' => 3,
            'comic_id' => 3,
            'title' => 'Cover',
            'path' => '/uploads/0/a188e5019e903b2bbdd59a8ec9a12036',
            'validated_at' => '2015-02-10 11:12:32',
            'user_id' => 2,
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
            'isShowable' => true,
            'user_id' => 2,
        ]);
        Strip::create([
            'id' => 14,
            'title' => 'Cover',
            'path' => '/uploads/0/07f485e2f27eb5916a5cff7835bab148',
            'validated_at' => '2015-02-18 17:48:38',
            'isShowable' => true,
            'comic_id' => 4,
            'user_id' => 3
        ]);
        Strip::create([
            'id' => 15,
            'title' => 'Chapter 2: Page 1',
            'path' => '/uploads/0/867cd02c9ebb7273fbe546f4ae8efd9e',
            'validated_at' => '2015-02-18 17:48:38',
            'isShowable' => true,
            'comic_id' => 4,
            'user_id' => 3
        ]);
        Strip::create([
            'id' => 16,
            'title' => 'Chapter 2: Page 2',
            'path' => '/uploads/0/6d6acd0feec256e7c66792a045c9d48e',
            'validated_at' => '2015-02-18 17:48:38',
            'isShowable' => true,
            'comic_id' => 4,
            'user_id' => 3
        ]);
        Strip::create([
            'id' => 17,
            'title' => 'Chapter 2: Page 3',
            'path' => '/uploads/0/3320eba7f169f693dcdb4341e34075f8',
            'comic_id' => 4,
            'user_id' => 3
        ]);
        Strip::create([
            'id' => 18,
            'title' => 'Chapter 2: Page 4',
            'path' => '/uploads/0/ae5fd4b465982ce4c7611506189e4c66',
            'comic_id' => 4,
            'user_id' => 3
        ]);
        Strip::create([
            'id' => 19,
            'title' => 'Chapter 2: Page 5',
            'path' => '/uploads/0/06ad150fa0d0e67062822cf4bcaaa70a',
            'validated_at' => '2015-02-18 17:48:38',
            'isShowable' => 1,
            'comic_id' => 4,
            'user_id' => 3
        ]);
        Strip::create([
            'id' => 20,
            'title' => 'Chapter 2: Page 6',
            'path' => '/uploads/0/610ff4d9cf2fabbf9ba7eac9ff7bfc2b',
            'comic_id' => 4,
            'user_id' => 3
        ]);
        Strip::create([
            'id' => 21,
            'title' => 'Chapter 2: Page 7',
            'path' => '/uploads/0/3e89ad9a80be9463a9453bb3c3b33da9',
            'comic_id' => 4,
            'user_id' => 3
        ]);
        Strip::create([
            'id' => 22,
            'title' => 'Chapter 2: Page 8',
            'path' => '/uploads/0/a3d87daf799ae0b55d8c922a2e4ee2fd',
            'comic_id' => 4,
            'user_id' => 3
        ]);
        Strip::create([
            'id' => 23,
            'title' => 'Chapter 2: Page 9',
            'path' => '/uploads/0/ad8e5d9cde40fe07c151eb3856f5c788',
            'comic_id' => 4,
            'user_id' => 3
        ]);
        Strip::create([
            'id' => 24,
            'title' => 'Chapter 2: Page 10',
            'path' => '/uploads/0/8da9f74e528156e3a6645d1812496aa7',
            'comic_id' => 4,
            'user_id' => 3
        ]);
        Strip::create([
            'id' => 25,
            'title' => 'Chapter 2: Page 11',
            'path' => '/uploads/0/f2b3626f91d495c8ca2c299bc5b122b5',
            'comic_id' => 4,
            'user_id' => 3
        ]);
        Strip::create([
            'id' => 26,
            'title' => 'Chapter 2: Page 12',
            'path' => '/uploads/0/4fd2415e0db16000eabb38a1739b2b4f',
            'comic_id' => 4,
            'user_id' => 3
        ]);
        Strip::create([
            'id' => 27,
            'title' => 'Chapter 2: Page 13',
            'path' => '/uploads/0/1d050698012e068aa4808fe6b834ed37',
            'comic_id' => 4,
            'user_id' => 3
        ]);
        Strip::create([
            'id' => 28,
            'title' => 'Chapter 2: Page 14',
            'path' => '/uploads/0/b3ccd9042a0696b319929b999d720ba6',
            'comic_id' => 4,
            'user_id' => 3
        ]);
    }
}
