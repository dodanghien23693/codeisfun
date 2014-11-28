<?php


class RoleTableSeeder extends Seeder {

        public function run()
        {
            Eloquent::unguard();
            
            $faker = Faker\Factory::create();
            
            
            Role::create(array(
                'id' => 2,
                'name' => 'manager'
            ));
            
            Role::create(array(
                'id' => 3,
                'name' => 'writer'
            ));
            
            Role::create(array(
                'id' => 4,
                'name' => 'user'
            ));
            
        }

}
