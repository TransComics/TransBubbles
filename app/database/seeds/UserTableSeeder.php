<?php

class UserTableSeeder extends Seeder {

    public function run() {
        User::unguard();
        
        User::create([
                'id'    => 1,
                'email' => 'admin@transcomics.com',
                'username' => 'admin',
                'password' => Hash::make('password')
        ]);
        User::create([
            'id'    => 2,
            'email' => 'amc@transcomics.com',
            'username' => 'amc',
            'password' => Hash::make('amc')
        ]);
        User::create([
            'id'    => 3,
            'email' => 'gbt',
            'username' => 'gbergere',
            'password' => Hash::make('gbt')
        ]);
    }
}

?>