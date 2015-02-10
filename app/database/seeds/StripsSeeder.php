<?php

class StripsSeeder extends Seeder {

    public function run() {
        DB::table('strips')->insert([
            [
                'id' => 1,
                'title' => 'Je suis projet',
                'path' => '/uploads/0/363b1c29fe79ecbd4a1777201ce11dee',
                'created_at' => '2015-02-10 10:49:43',
                'updated_at' => '2015-02-10 10:49:43'
            ],
            [
                'id' => 2,
                'title' => 'Portable du père',
                'path' => '/uploads/0/cdb8a777ccf2c7c539cafe4e670c72e2',
                'created_at' => '2015-02-10 10:50:01',
                'updated_at' => '2015-02-10 10:50:01'
            ],
            [
                'id' => 3,
                'title' => 'Devop ?',
                'path' => '/uploads/0/58f19710798ee712be8efaeba131f768',
                'created_at' => '2015-02-10 10:50:09',
                'updated_at' => '2015-02-10 10:50:09'
            ]
        ]);
    }

}
