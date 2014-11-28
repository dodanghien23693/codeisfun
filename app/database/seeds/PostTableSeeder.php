<?php


class PostTableSeeder extends Seeder {

        public function run()
        {
            Eloquent::unguard();
            
            $faker = Faker\Factory::create();
            /*
            Role::create(array(
                'id'=>1,
                'name'=>'admin'
            ));
            
            PostVisibility::create(array(
                'id'=> 1 ,
                'name'=> 'visible'
            ));
            
            PostStatus::create(array(
                'id'=>1,
                'name'=>'publish'
            ));
            
            User::create(array(
                'id' => 1,
                'username'      => 'dodanghien',
                'email'         => $faker->email,
                'password'      => $p = $faker->userName, 
                'first_name'    => $faker->firstName,
                'last_name'     => $faker->lastName,
                'role_id'       => 1,
                'user_type'     => 'codeisfun'
            ));
             * 
             */
            
            for($i=0;$i<10;$i++)
            {
                Post::create(array(
                    'slug' => $faker->slug(10),
                    'title' => $faker->sentence($faker->numberBetween(10,20)),
                    
                    'description'   => $faker->sentence(20),
                    'content'       => $faker->paragraph(10),
                    'post_status_id'=>1,
                    'post_visibility_id'=>1,
                    'user_id'=>1,
                    'cover_image_url'=> $faker->imageUrl($width = 640, $height = 480) 
                    )
                );
            }
               
            
        }

}
