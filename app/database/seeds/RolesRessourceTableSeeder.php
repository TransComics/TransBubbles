<?php

class RolesRessourceTableSeeder extends Seeder {

    public function run() {
        RoleRessource::unguard();

        RoleRessource::create([
            'role_id' => 1,
            'ressource' => 'strip',
            'user_id' => 1
        ]);
        RoleRessource::create([
            'role_id' => '2',
            'user_id' => 3
        ]);
    }

}
