<?php
use Faker\Provider;

use League\FactoryMuffin\Facade as Muffin;

$faker = Faker\Factory::create();

Muffin::define('PostStatus',array(
    'name'   => $faker->name,
));

Muffin::define('PostVisibility',array(
    'name'   => $faker->name,
));

Muffin::define('Post' , array(
    'title' => 'sentence|10,20',
    'slug' => 'sentence|6,10',
    'description'   => 'sentence|20',
    'content'       => 'paragraph|10',
    'post_status_id'=> 'factory|PostStatus',
    'post_visibility_id' => 'factory|PostVisibility',
    'public_time'   => DateTime::createFromFormat('yyyy-MM-dd HH:mm:ss', '10:10:10'),
    'user_id' => 'factory|User',
    'cover_image_url' => Provider\Image::imageUrl()
));




Muffin::define('Role' , array(
    'name' => $faker->name
));

Muffin::define('User', array(
    'username'      => $faker->userName(15),
    'email'         => 'email',
    'password'      => $p = $faker->userName,
    'password_confirmation' => $p,   
    'first_name'    => 'firstName',
    'last_name'     => 'lastName',
    'role_id'       => 'factory|Role',
    'user_type'     => 'codeisfun'
));



Muffin::define('Category',array(
    'name'      => $faker->name
));


Muffin::define('Comment',array(
    
));
