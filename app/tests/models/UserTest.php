<?php

class UserTest extends TestCase{

    public static function setupBeforeClass()
    {
        \League\FactoryMuffin\Facade::loadFactories(__DIR__ . '/../factories');
    }

    public static function tearDownAfterClass()
    {
        \League\FactoryMuffin\Facade::deleteSaved();
    }

    /**
     * Username is required
     */
    public function testUsernameIsRequired()
    {




        $user = \League\FactoryMuffin\Facade::create('User');




        $this->assertInstanceOf('User', $user);

        $post = \League\FactoryMuffin\Facade::create('Post');
        $this->assertInstanceOf('Post', $post);

        var_dump(User::find(1)->toJson());
        var_dump(Post::find(1)->toJson());

        // User should not save
        //$this->assertTrue($user->save());
        // Save the errors
        //$errors = $user->errors()->all();
        //There should be 1 error
        //$this->assertCount(1, $errors);
        // The username error should be set
        // $this->assertEquals($errors[0], "The u.");
    }

}
