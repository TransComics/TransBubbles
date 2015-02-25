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
        $this->call('StripsTableSeeder');
        $this->call('ShapesTableSeeder');
        $this->call('BubblesTableSeeder');
        $this->call('RolesTableSeeder');
        $this->call('RolesRessourceTableSeeder');
        $this->call('PopularitiesTableSeeder');
    }
}
