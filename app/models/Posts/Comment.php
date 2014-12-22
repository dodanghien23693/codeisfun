<?php

class Comment extends Eloquent{
    
    protected $table = "comments";
    
    protected $fillable = array('content','commentable_id','commentable_type','parent_commentable_id');
    
    
    /**
    * Ardent validation rules
    */
    public static $rules = array(
      'content'     => 'required|min:50',
        'commentable_id' => 'required|integer',
        'commentable_type' => 'required',
        'parent_commentable_id'    => 'integer'
    );
    
    
    /* post
     * 
     */
    public function post()
    {
        return $this->belongsTo("Post");
    }
    
    /* user
     * 
     */
    public function user()
    {
        return $this->belongsTo("User");
    }
    

    public function commentable()
    {
        return $this->morphTo();
    }

}