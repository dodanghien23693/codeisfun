<?php namespace CodeIsFun\Repositories;

use Post;

class PostRepository extends Post{
    
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }
    
}


