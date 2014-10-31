<?php

use LaravelBook\Ardent\Ardent;

class Resource extends Ardent{
    
    protected $table = "resources";
    
    protected $fillable = array('path');
    
    //protected fields : id, lecture_id, resource_type_id
    
    /**
    * Ardent validation rules
    */
    public static $rules = array(
      
    );
    
    /**
     * each resource belong to one lecture
     */
    public function lecture()
    {
        return $this->belongsTo('Lecture', 'lecture_id');
    }
    
    /**
     * each resource belong to one resource_type
     */
    public function type()
    {
        return $this->belongsTo('ResourceType', 'resource_type_id');
    }


}
