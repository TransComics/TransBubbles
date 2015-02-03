<?php
class UserTableSeeder extends Seeder {
	public function run() {
		DB::table ( 'users' )->insert ( array (
				array (
						'email' => 'admin@transcomics.com',
						'username' => 'admin',
						'password' => Hash::make ( 'password' ) 
				) 
		) );
	}
}

?>