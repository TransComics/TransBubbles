<?php

class StripsSeeder extends Seeder {

    public function run() {
        Strips::unguard();

        Strips::create([
            'id' => 1,
            'title' => 'Je suis projet',
            'path' => '/uploads/0/363b1c29fe79ecbd4a1777201ce11dee',
            'validated_at' => '2015-02-10 11:12:32',
        ]);
        Strips::create([
            'id' => 2,
            'title' => 'Portable du père',
            'path' => '/uploads/0/cdb8a777ccf2c7c539cafe4e670c72e2',
        ]);
        Strips::create([
            'id' => 3,
            'title' => 'Devop ?',
            'path' => '/uploads/0/58f19710798ee712be8efaeba131f768',
            'validated_at' => '2015-02-10 11:12:32',
        ]);
    }

}
