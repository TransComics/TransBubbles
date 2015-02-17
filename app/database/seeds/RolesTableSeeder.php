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
            'name' => 'Administrator'
        ]);
        Role::create([
            'id' => 2,
            'C' => true,
            'R' => true,
            'U' => false,
            'M' => false,
            'D' => false,
            'name' => 'Guest'
        ]);
    }

}
