<?php

class StripsTableSeeder extends Seeder {

    public function run() {
        Strip::unguard();

        Strip::create([
            'id' => 3,
            'index' => 3,
            'comic_id' => 3,
            'title' => 'Cover',
            'path' => '/uploads/0/a188e5019e903b2bbdd59a8ec9a12036',
            'validated_by' => 5,
            'validated_at' => '2015-02-20 13:08:28',
            'validated_state' => 'VALIDATED',
            'validated_comments' => NULL,
            'user_id' => 2,
        ]);
        Strip::create([
            'id' => 4,
            'index' => 4,
            'comic_id' => 3,
            'isShowable' => true,
            'title' => 'Chapter 1: Page 1',
            'path' => '/uploads/0/5d46295fe2f7127018786ae6185e4412',
            'validated_by' => 5,
            'validated_at' => '2015-02-20 13:08:28',
            'validated_state' => 'VALIDATED',
            'validated_comments' => NULL,
            'user_id' => 2,
        ]);
        Strip::create([
            'id' => 5,
            'index' => 5,
            'comic_id' => 3,
            'isShowable' => true,
            'title' => 'Chapter 1: Page 2',
            'path' => '/uploads/0/af83c70e0911c75aca1010a3409d12a3',
            'validated_by' => 5,
            'validated_at' => '2015-02-20 13:08:28',
            'validated_state' => 'VALIDATED',
            'validated_comments' => NULL,
            'user_id' => 2,
        ]);
        Strip::create([
            'id' => 6,
            'index' => 6,
            'comic_id' => 3,
            'title' => 'Chapter 1: Page 3',
            'path' => '/uploads/0/26ef3aa7f59d0bec5a663053b776c0cd',
            'validated_by' => 5,
            'validated_at' => '2015-02-20 13:08:28',
            'validated_state' => 'VALIDATED',
            'validated_comments' => NULL,
            'user_id' => 2,
            'validated_at' => '2015-02-10 11:12:32',
            'user_id' => 2
        ]);
        Strip::create([
            'id' => 7,
            'index' => 7,
            'comic_id' => 3,
            'title' => 'Chapter 1: Page 4',
            'path' => '/uploads/0/513a5bb8df3120b04a138efbed15f658',
            'validated_by' => 5,
            'validated_at' => '2015-02-20 13:08:28',
            'validated_state' => 'VALIDATED',
            'validated_comments' => NULL,
            'user_id' => 2,
        ]);
        Strip::create([
            'id' => 8,
            'index' => 8,
            'comic_id' => 3,
            'title' => 'Chapter 1: Page 5',
            'path' => '/uploads/0/9a1381ff92b12821e0c90185fcc90932',
            'validated_by' => 5,
            'validated_at' => '2015-02-20 13:08:28',
            'validated_state' => 'VALIDATED',
            'validated_comments' => NULL,
            'user_id' => 2,
        ]);
        Strip::create([
            'id' => 9,
            'index' => 9,
            'comic_id' => 3,
            'title' => 'Chapter 1: Page 6',
            'path' => '/uploads/0/65d811bbe303f9cec469566dfad82ca0',
            'validated_by' => 5,
            'validated_at' => '2015-02-20 13:08:28',
            'validated_state' => 'VALIDATED',
            'validated_comments' => NULL,
            'user_id' => 2,
        ]);
        Strip::create([
            'id' => 10,
            'index' => 10,
            'isShowable' => true,
            'comic_id' => 3,
            'title' => 'Chapter 1: Page 7',
            'path' => '/uploads/0/a6fb13723e74cb9a6ca86b9862a75691',
            'validated_by' => 5,
            'validated_at' => '2015-02-20 13:08:28',
            'validated_state' => 'VALIDATED',
            'validated_comments' => NULL,
            'user_id' => 2,
        ]);
        Strip::create([
            'id' => 11,
            'index' => 11,
            'comic_id' => 3,
            'title' => 'Chapter 1: Page 8',
            'path' => '/uploads/0/3da206455ad26d107108752a484a4003',
            'validated_by' => 5,
            'validated_at' => '2015-02-20 13:08:28',
            'validated_state' => 'VALIDATED',
            'validated_comments' => NULL,
            'user_id' => 2,
        ]);
        Strip::create([
            'id' => 12,
            'index' => 12,
            'comic_id' => 3,
            'title' => 'Chapter 1: Page 9',
            'path' => '/uploads/0/21023a8b83a32fa58d62fbcc2914a5a0',
            'validated_by' => 5,
            'validated_at' => '2015-02-20 13:08:28',
            'validated_state' => 'VALIDATED',
            'validated_comments' => NULL,
            'user_id' => 2,
        ]);
        Strip::create([
            'id' => 13,
            'index' => 13,
            'comic_id' => 3,
            'title' => 'Chapter 1: Page 10',
            'path' => '/uploads/0/4add9b73d5ab647ee47aebcd0438eb30',
            'validated_at' => '2015-02-10 11:12:32',
            'validated_by' => 5,
            'validated_at' => '2015-02-20 13:08:28',
            'validated_state' => 'VALIDATED',
            'validated_comments' => NULL,
            'isShowable' => true,
            'user_id' => 2
        ]);
        Strip::create([
            'id' => 14,
            'index' => 14,
            'title' => 'Cover',
            'path' => '/uploads/0/07f485e2f27eb5916a5cff7835bab148',
            'validated_at' => '2015-02-18 17:56:38',
            'validated_by' => 5,
            'validated_at' => '2015-02-20 13:08:28',
            'validated_state' => 'VALIDATED',
            'validated_comments' => NULL,
            'isShowable' => true,
            'comic_id' => 4,
            'user_id' => 3
        ]);
        Strip::create([
            'id' => 15,
            'index' => 15,
            'title' => 'Chapter 2: Page 1',
            'path' => '/uploads/0/867cd02c9ebb7273fbe546f4ae8efd9e',
            'validated_at' => '2015-02-18 17:58:38',
            'validated_by' => 5,
            'validated_at' => '2015-02-20 13:08:28',
            'validated_state' => 'VALIDATED',
            'validated_comments' => NULL,
            'isShowable' => true,
            'comic_id' => 4,
            'user_id' => 3
        ]);
        Strip::create([
            'id' => 16,
            'index' => 16,
            'title' => 'Chapter 2: Page 2',
            'path' => '/uploads/0/6d6acd0feec256e7c66792a045c9d48e',
            'comic_id' => 4,
            'user_id' => 3,
            'validated_by' => 5,
            'validated_at' => '2015-02-20 13:08:28',
            'validated_state' => 'VALIDATED',
            'validated_comments' => NULL,
            'isShowable' => true,
        ]);
        Strip::create([
            'id' => 17,
            'index' => 17,
            'title' => 'Chapter 2: Page 3',
            'path' => '/uploads/0/3320eba7f169f693dcdb4341e34075f8',
            'comic_id' => 4,
            'user_id' => 3,
            'validated_by' => 5,
            'validated_at' => '2015-02-20 13:08:28',
            'validated_state' => 'VALIDATED',
            'validated_comments' => NULL,
            'isShowable' => true,
        ]);
        Strip::create([
            'id' => 18,
            'index' => 18,
            'title' => 'Chapter 2: Page 4',
            'path' => '/uploads/0/ae5fd4b465982ce4c7611506189e4c66',
            'comic_id' => 4,
            'user_id' => 3,
            'validated_by' => 5,
            'validated_at' => '2015-02-20 13:08:28',
            'validated_state' => 'VALIDATED',
            'validated_comments' => NULL,
            'isShowable' => true,
        ]);
        Strip::create([
            'id' => 19,
            'index' => 19,
            'title' => 'Chapter 2: Page 5',
            'path' => '/uploads/0/06ad150fa0d0e67062822cf4bcaaa70a',
            'validated_at' => '2015-02-18 18:48:38',
            'validated_by' => 5,
            'validated_at' => '2015-02-20 13:08:28',
            'validated_state' => 'VALIDATED',
            'validated_comments' => NULL,
            'isShowable' => true,
            'comic_id' => 4,
            'user_id' => 3
        ]);
        Strip::create([
            'id' => 20,
            'index' => 20,
            'title' => 'Chapter 2: Page 6',
            'path' => '/uploads/0/610ff4d9cf2fabbf9ba7eac9ff7bfc2b',
            'comic_id' => 4,
            'user_id' => 3
        ]);
        Strip::create([
            'id' => 21,
            'index' => 21,
            'title' => 'Chapter 2: Page 7',
            'path' => '/uploads/0/3e89ad9a80be9463a9453bb3c3b33da9',
            'comic_id' => 4,
            'user_id' => 3
        ]);
        Strip::create([
            'id' => 22,
            'index' => 22,
            'title' => 'Chapter 2: Page 8',
            'path' => '/uploads/0/a3d87daf799ae0b55d8c922a2e4ee2fd',
            'comic_id' => 4,
            'user_id' => 3
        ]);
        Strip::create([
            'id' => 23,
            'index' => 23,
            'title' => 'Chapter 2: Page 9',
            'path' => '/uploads/0/ad8e5d9cde40fe07c151eb3856f5c788',
            'comic_id' => 4,
            'user_id' => 3
        ]);
        Strip::create([
            'id' => 24,
            'index' => 24,
            'title' => 'Chapter 2: Page 10',
            'path' => '/uploads/0/8da9f74e528156e3a6645d1812496aa7',
            'comic_id' => 4,
            'user_id' => 3
        ]);
        Strip::create([
            'id' => 25,
            'index' => 25,
            'title' => 'Chapter 2: Page 11',
            'path' => '/uploads/0/f2b3626f91d495c8ca2c299bc5b122b5',
            'comic_id' => 4,
            'user_id' => 3
        ]);
        Strip::create([
            'id' => 26,
            'index' => 26,
            'title' => 'Chapter 2: Page 12',
            'path' => '/uploads/0/4fd2415e0db16000eabb38a1739b2b4f',
            'comic_id' => 4,
            'user_id' => 3
        ]);
        Strip::create([
            'id' => 27,
            'index' => 27,
            'title' => 'Chapter 2: Page 13',
            'path' => '/uploads/0/1d050698012e068aa4808fe6b834ed37',
            'comic_id' => 4,
            'user_id' => 3
        ]);
        Strip::create([
            'id' => 28,
            'index' => 28,
            'title' => 'Chapter 2: Page 14',
            'path' => '/uploads/0/b3ccd9042a0696b319929b999d720ba6',
            'comic_id' => 4,
            'user_id' => 3
        ]);

        Strip::create([
            'id' => 47,
            'index' => 47,
            'title' => 'noises',
            'path' => '/uploads/0/b9efda09717de713de1cffd9e71c5b9f',
            'comic_id' => '5',
            'user_id' => '1',
            'created_at' => '2015-02-20 13:12:02',
            'updated_at' => '2015-02-20 13:12:02',
            'validated_state' => 'PENDING'
        ]);

        Strip::create([
            'id' => 45,
            'index' => 45,
            'title' => 'coolguy',
            'path' => '/uploads/0/5d472a1fdb3d0da664f04ee449fe116e',
            'comic_id' => '5',
            'user_id' => '1',
            'isShowable' => true,
            'created_at' => '2015-02-20 12:42:47',
            'updated_at' => '2015-02-20 12:44:58',
            'validated_by' => '1',
            'validated_at' => '2015-02-20 12:44:58',
            'validated_state' => 'VALIDATED'
        ]);

        Strip::create([
            'id' => 44,
            'index' => 44,
            'title' => 'party',
            'path' => '/uploads/0/47bc270655ce68e7f9b98d296bc95047',
            'comic_id' => '5',
            'user_id' => '1',
            'created_at' => '2015-02-20 12:01:00',
            'updated_at' => '2015-02-20 12:44:43',
            'validated_by' => '1',
            'validated_at' => '2015-02-20 12:44:43',
            'validated_state' => 'VALIDATED'
        ]);

        Strip::create([
            'id' => 33,
            'index' => 33,
            'title' => 'lava',
            'path' => '/uploads/0/f227a6e4512b980103603cd05c5221c3',
            'comic_id' => '5',
            'user_id' => '1',
            'isShowable' => true,
            'created_at' => '2015-02-20 11:54:45',
            'updated_at' => '2015-02-20 12:45:00',
            'validated_by' => '1',
            'validated_at' => '2015-02-20 12:45:00',
            'validated_state' => 'VALIDATED'
        ]);

        Strip::create([
            'id' => 34,
            'index' => 34,
            'title' => 'note',
            'path' => '/uploads/0/29a7f536a0927d062e373bba34eb4379',
            'comic_id' => '5',
            'user_id' => '1',
            'isShowable' => true,
            'created_at' => '2015-02-20 11:56:01',
            'updated_at' => '2015-02-20 12:44:31',
            'validated_by' => '1',
            'validated_at' => '2015-02-20 12:44:31',
            'validated_state' => 'VALIDATED'
        ]);

        Strip::create([
            'id' => 29,
            'index' => 29,
            'title' => 'Chapter 1: Page 11',
            'path' => '/uploads/0/e7e44cb550637cf5ea89ac2282cd06a5',
            'isShowable' => false,
            'comic_id' => '3',
            'user_id' => '2',
            'created_at' => '2015-02-20 11:49:10',
            'updated_at' => '2015-02-20 12:13:02',
            'validated_by' => '2',
            'validated_at' => '2015-02-20 12:13:02',
            'validated_state' => 'VALIDATED',
            'validated_comments' => NULL,
        ]);

        Strip::create([
            'id' => 30,
            'index' => 30,
            'title' => 'Chapter 1: Page 12',
            'path' => '/uploads/0/bab2fd23024cc4bcb2e62b1f64528d33',
            'isShowable' => false,
            'comic_id' => '3',
            'user_id' => '2',
            'created_at' => '2015-02-20 11:49:39',
            'updated_at' => '2015-02-20 12:12:52',
            'validated_by' => '2',
            'validated_at' => '2015-02-20 12:12:52',
            'validated_state' => 'VALIDATED',
            'validated_comments' => NULL,
        ]);

        Strip::create([
            'id' => 31,
            'index' => 31,
            'title' => 'Chapter 1: Page 13',
            'path' => '/uploads/0/57627b1de6d0f96932aacecc90e247e4',
            'isShowable' => false,
            'comic_id' => '3',
            'user_id' => '2',
            'created_at' => '2015-02-20 11:50:23',
            'updated_at' => '2015-02-20 11:50:23',
            'validated_by' => NULL,
            'validated_at' => NULL,
            'validated_state' => 'PENDING',
            'validated_comments' => NULL,
        ]);

        Strip::create([
            'id' => 35,
            'index' => 35,
            'title' => 'Chapter 1: Page 14',
            'path' => '/uploads/0/385710f320bc2b89c2e31c899c909861',
            'isShowable' => false,
            'comic_id' => '3',
            'user_id' => '2',
            'created_at' => '2015-02-20 11:56:27',
            'updated_at' => '2015-02-20 12:12:50',
            'validated_by' => '2',
            'validated_at' => '2015-02-20 12:12:50',
            'validated_state' => 'VALIDATED',
            'validated_comments' => NULL,
        ]);

        Strip::create([
            'id' => 36,
            'index' => 36,
            'title' => 'Chapter 1: Page 15',
            'path' => '/uploads/0/d583967cfdfabd2b05f3dd5e519d3b79',
            'isShowable' => false,
            'comic_id' => '3',
            'user_id' => '2',
            'created_at' => '2015-02-20 11:57:49',
            'updated_at' => '2015-02-20 11:57:49',
            'validated_by' => NULL,
            'validated_at' => NULL,
            'validated_state' => 'PENDING',
            'validated_comments' => NULL,
        ]);

        Strip::create([
            'id' => 37,
            'index' => 37,
            'title' => 'Chapter 1: Page 16',
            'path' => '/uploads/0/5cafefd3b3dc82f3e7712479993683db',
            'isShowable' => false,
            'comic_id' => '3',
            'user_id' => '2',
            'created_at' => '2015-02-20 11:58:05',
            'updated_at' => '2015-02-20 11:58:05',
            'validated_by' => NULL,
            'validated_at' => NULL,
            'validated_state' => 'PENDING',
            'validated_comments' => NULL,
        ]);

        Strip::create([
            'id' => 38,
            'index' => 38,
            'title' => 'Chapter 1: Page 17',
            'path' => '/uploads/0/da328a49bd88395901a20cdfed44dfd3',
            'isShowable' => true,
            'comic_id' => '3',
            'user_id' => '2',
            'created_at' => '2015-02-20 11:58:14',
            'updated_at' => '2015-02-20 11:58:14',
            'validated_by' => NULL,
            'validated_at' => NULL,
            'validated_state' => 'PENDING',
            'validated_comments' => NULL,
        ]);

        Strip::create([
            'id' => 39,
            'index' => 39,
            'title' => 'Chapter 1: Page 18',
            'path' => '/uploads/0/f18bbfce7fb742c6f02cfad48dae0e89',
            'isShowable' => false,
            'comic_id' => '3',
            'user_id' => '2',
            'created_at' => '2015-02-20 11:58:24',
            'updated_at' => '2015-02-20 12:12:53',
            'validated_by' => '2',
            'validated_at' => '2015-02-20 12:12:53',
            'validated_state' => 'VALIDATED',
            'validated_comments' => NULL,
        ]);

        Strip::create([
            'id' => 40,
            'index' => 40,
            'title' => 'Chapter 1: Page 19',
            'path' => '/uploads/0/5ce4e4fca7bcb7353b1ee6f57b6b660a',
            'isShowable' => false,
            'comic_id' => '3',
            'user_id' => '2',
            'created_at' => '2015-02-20 11:58:37',
            'updated_at' => '2015-02-20 11:58:37',
            'validated_by' => NULL,
            'validated_at' => NULL,
            'validated_state' => 'PENDING',
            'validated_comments' => NULL,
        ]);

        Strip::create([
            'id' => 41,
            'index' => 41,
            'title' => 'Chapter 1: Page 20',
            'path' => '/uploads/0/1cbfc9cd930bb21492926e4c839502a9',
            'isShowable' => false,
            'comic_id' => '3',
            'user_id' => '2',
            'created_at' => '2015-02-20 11:58:48',
            'updated_at' => '2015-02-20 11:58:48',
            'validated_by' => NULL,
            'validated_at' => NULL,
            'validated_state' => 'PENDING',
            'validated_comments' => NULL,
        ]);

        Strip::create([
            'id' => 42,
            'index' => 42,
            'title' => 'Chapter 1: Page 21',
            'path' => '/uploads/0/4d8bf2d8bf7d9a8a7ac328ce7107add2',
            'isShowable' => false,
            'comic_id' => '3',
            'user_id' => '2',
            'created_at' => '2015-02-20 11:59:00',
            'updated_at' => '2015-02-20 11:59:00',
            'validated_by' => NULL,
            'validated_at' => NULL,
            'validated_state' => 'PENDING',
            'validated_comments' => NULL,
        ]);

        Strip::create([
            'id' => 43,
            'index' => 43,
            'title' => 'Chapter 1: Page 22',
            'path' => '/uploads/0/f2f28bbd4da87ea42440cc60910d1ad3',
            'isShowable' => true,
            'comic_id' => '3',
            'user_id' => '2',
            'created_at' => '2015-02-20 11:59:16',
            'updated_at' => '2015-02-20 12:12:48',
            'validated_by' => '2',
            'validated_at' => '2015-02-20 12:12:48',
            'validated_state' => 'VALIDATED',
            'validated_comments' => NULL,
        ]);

        Strip::create([
            'id' => '46',
            'index' => 46,
            'title' => '#234',
            'path' => '/uploads/0/049811a2314c0df98a594f4b131583a6',
            'isShowable' => false,
            'comic_id' => '6',
            'user_id' => '4',
            'created_at' => '2015-02-20 12:52:34',
            'updated_at' => '2015-02-20 13:09:57',
            'validated_by' => '4',
            'validated_at' => '2015-02-20 13:09:57',
            'validated_state' => 'VALIDATED',
            'validated_comments' => NULL,
        ]);
    }

}
