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
        User::create([
            'id' => 4,
            'email' => 'gu.roux@gmail.com',
            'username' => 'Graam94',
            'password' => '$2y$10$8vyMKz7P/s92dKc.LpHk8OtWaLHjO5GoiX..bK0uYNI4Fnd/Aa6RK'
        ]);
    }
}

?>