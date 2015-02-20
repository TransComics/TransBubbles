<?php

class UsersTableSeeder extends Seeder {

    public function run() {
        User::unguard();
        
        User::create([
            'id'    => 1,
            'email' => 'ryushin75@gmail.com',
            'username' => 'ryushin75',
            'password' => Hash::make('laravel')
        ]);
        User::create([
            'id'    => 2,
            'email' => 'amc@transcomics.com',
            'username' => 'amc',
            'password' => Hash::make('amc')
        ]);
        User::create([
            'id'    => 3,
            'email' => 'geoffrey.bergeret@gbergeret.org',
            'username' => 'gbergere',
            'password' => Hash::make('gbergere')
        ]);
        User::create([
            'id' => 4,
            'email' => 'gu.roux@gmail.com',
            'username' => 'Graam94',
            'password' => '$2y$10$8vyMKz7P/s92dKc.LpHk8OtWaLHjO5GoiX..bK0uYNI4Fnd/Aa6RK'
        ]);
        User::create([
            'id' => 5,
            'email' => 'admin',
            'username' => 'admin',
            'password' => Hash::make('admin')
        ]);
        User::create([
            'id' => 6,
            'email' => 'dio_brando@live.fr',
            'username' => 'Dio94',
            'password' => '$2y$10$VJSgWTB324sX/MPidlATVOBfCd3AIyesyQaSSr952g6CamyATihPi'
        ]);
    }
}

?>