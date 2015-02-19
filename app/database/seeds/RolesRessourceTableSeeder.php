<?php

class RolesRessourceTableSeeder extends Seeder {

    public function run() {
        RoleRessource::unguard();
        
        RoleRessource::create([
            'role_id' => 2,
            'user_id' => 3
        ]);
    }

}
