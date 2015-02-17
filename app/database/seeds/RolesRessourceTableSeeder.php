<?php

class RolesRessourceTableSeeder extends Seeder {

    public function run() {
        RoleRessource::unguard();
        
        RoleRessource::create([
            'role_id' => 1,
            'ressource' => 'strip'
        ]);
        RoleRessource::create([
            'role_id' => '2'
        ]);
    }

}
