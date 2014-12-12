<?php

class Role extends Eloquent{
    
    
    PUBLIC STATIC $ROLE_USER = 1;
    PUBLIC STATIC $ROLE_WRITER = 2;
    PUBLIC STATIC $ROLE_MANAGER = 3;
    PUBLIC STATIC $ROLE_ADMIN = 4;
    
    protected $table = "roles";
    
    public $timestamps = false;
    protected $fillable = array('name');
    

    
    /* user
     * 
     */
    public function user(){
        return $this->belongsTo("User");
    }
    
    public static function name($id){
    dd($id);
        return Role::find($id)->name;
    }
    

}