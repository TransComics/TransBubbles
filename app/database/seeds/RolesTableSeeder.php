<?php

class RolesTableSeeder extends Seeder {

    public function run() {
        Role::create([
            'id' => 1,
            'C' => true,
            'R' => true,
            'U' => true,
            'M' => true,
            'D' => true,
            'name' => 'Super Administrator',
            'protected' => true
        ]);
        Role::create([
            'id' => 2,
            'C' => true,
            'R' => true,
            'U' => true,
            'M' => true,
            'D' => true,
            'name' => 'Administrator',
            'protected' => true
        ]);
        Role::create([
            'id' => 3,
            'C' => true,
            'R' => true,
            'U' => false,
            'M' => true,
            'D' => false,
            'name' => 'Moderator',
            'protected' => true
        ]);
        Role::create([
            'id' => 4,
            'C' => true,
            'R' => true,
            'U' => false,
            'M' => false,
            'D' => false,
            'name' => 'Guest',
            'protected' => true
        ]);
    }

}
