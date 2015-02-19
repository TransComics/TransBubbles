<?php

class RolesRessourceTableSeeder extends Seeder {

    public function run() {
        RoleRessource::unguard();

        // All rights for admin
        RoleRessource::create([
            'id' => 1,
            'role_id' => 1,
            'user_id' => 5
        ]);

        // Bergeret is admin of chapter2
        RoleRessource::create([
            'id' => 2,
            'role_id' => 2,
            'user_id' => 3,
            'ressource' => 1,
            'ressource_id' => 4
        ]);

        // AMC is admin of chapter1
        RoleRessource::create([
            'id' => 3,
            'role_id' => 2,
            'user_id' => 2,
            'ressource' => 1,
            'ressource_id' => 3
        ]);
    }

}
