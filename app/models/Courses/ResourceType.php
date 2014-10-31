<?php

use LaravelBook\Ardent\Ardent;

class ResourceType extends Ardent{
    
    protected $table = "resource_type";
    
    protected $fillable = array('name');
    
    //protected fields : id
    
    /**
    * Ardent validation rules
    */
    public static $rules = array(
      
    );
    
    /**
     * each resource_type has many resources
     */
    public function resources()
    {
        return $this->hasMany('Resource');
    }
      
    
}
