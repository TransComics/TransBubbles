<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Eloquent::unguard();
        $this->call('FontsTableSeeder');
        $this->call('LanguagesTableSeeder');
        $this->call('UsersTableSeeder');
        $this->call('ComicsTableSeeder');
        $this->call('StripsSeeder');
        $this->call('ShapesSeeder');
        $this->call('RolesTableSeeder');
        $this->call('RolesRessourceTableSeeder');
    }
}
