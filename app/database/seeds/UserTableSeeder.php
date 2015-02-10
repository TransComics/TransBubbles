<?php

class UserTableSeeder extends Seeder {

    public function run() {
        DB::table('users')->insert(array(
            array(
                'email' => 'admin@transcomics.com',
                'username' => 'admin',
                'password' => Hash::make('password')
            ),
            array(
                'email' => 'amc@transcomics.com',
                'username' => 'amc',
                'password' => Hash::make('amc')
            ),
            array(
                'email' => 'gbt',
                'username' => 'gbergere',
                'password' => Hash::make('gbt')
            )
        ));
    }
}

?>