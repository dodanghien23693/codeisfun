<?php
use LaravelBook\Ardent\Ardent;

class Role extends Ardent{
    
    protected $table = "roles";
    
    public $timestamps = false;
    protected $fillable = array('name');
    
    /**
    * Ardent validation rules
    */
    public static $rules = array(
      
    );
    
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