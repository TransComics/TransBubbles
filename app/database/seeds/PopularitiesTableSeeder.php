    <?php

    class PopularitiesTableSeeder extends Seeder {

        public function run()
        {
            Popularities::unguard();
            
            Popularities::create([
                    'id'    => 1,
                    'strip_id' => 4
            ]);
            Popularities::create([
                     'id'    => 2,
                    'strip_id' => 5
            ]);
            Popularities::create([
                    'id'    => 3,
                    'strip_id' => 10
            ]);
            Popularities::create([
                     'id'    => 4,
                    'strip_id' => 13
            ]);
            Popularities::create([
                     'id'    => 5,
                    'strip_id' => 14
            ]);
            Popularities::create([
                    'id'    => 6,
                    'strip_id' => 15
            ]);
            Popularities::create([
                    'id'    => 7,
                    'strip_id' => 16
            ]);
            Popularities::create([
                    'id'    => 8,
                    'strip_id' => 17 
            ]);

            Popularities::create([
                     'id'    => 9,
                    'strip_id' => 18
            ]);
            Popularities::create([
                    'id'    => 10, 
                    'strip_id' => 19
            ]);
            Popularities::create([
                    'id'    => 11,
                    'strip_id' => 33
            ]);

            Popularities::create([
                    'id'    => 12,
                    'strip_id' => 34
            ]);
            Popularities::create([
                     'id'    => 13,
                    'strip_id' => 38
            ]);

            Popularities::create([
                     'id'    => 14,
                    'strip_id' => 43
            ]);

            Popularities::create([
                     'id'    => 15,
                    'strip_id' => 45
            ]);

            Popularities::create([
                     'id'    => 16,
                    'strip_id' => 46
            ]);
        }
    }