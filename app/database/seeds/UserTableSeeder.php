<?php

class UserTableSeeder extends Seeder {

    public function run() {
        DB::table('users')->insert(array(
            array(
                'email' => 'admin@transcomics.com',
                'username' => 'admin',
                'password' => Hash::make('password'),
                'created_at' => '2015-02-03 18:08:56'
            )
        ));
    }
}

?>