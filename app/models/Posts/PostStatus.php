<?php

class PostStatus extends Eloquent{
    
    PUBLIC STATIC $POST_STATUS_PUBLIC = 1;
    PUBLIC STATIC $POST_STATUS_PRIVATE = 2;
    PUBLIC STATIC $POST_STATUS_PENDING = 3;
    PUBLIC STATIC $POST_STATUS_DRAFT = 4;
    PUBLIC STATIC $POST_STATUS_INVALID = 5;
    PUBLIC STATIC $POST_STATUS_TRASHED = 6;
    
    protected $table = "post_status";
    
    protected $fillable = array('name');
    

    /* posts
     * 
     */
    public function posts(){
        return $this->hasMany("Post", "status_id");
    }

}