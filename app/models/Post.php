<?php
use LaravelBook\Ardent\Ardent;


class Post extends Ardent {
    
    protected $table = "posts";
    use Illuminate\Database\Eloquent\SoftDeletingTrait;
    
    protected $dates = ['deleted_at'];
    protected $softDelete = true; 
    protected $fillable = array('user_id','slug','title','cover_image_url',
        'description','content','public_time','view_count','comment_count','post_status_id');
    
    /**
    * Ardent validation rules
    */
    public static $rules = array(
      
    );
    
    /* tags
     * Liên kết nhiều nhiều thông qua bảng post_tag
     * 
     */
    public function tags(){
        return $this->belongsToMany("Tag", "post_tag");
    }
    
    
    /* status
     * 
     */
    public function status(){
        return $this->belongsTo("PostStatus","post_status_id");
    }
    
    /* visibility
     * 
     */
    public function visibility(){
        return $this->belongsTo("Visibility","visibility_id");
    }
    
    
    /* ratings
     * 
     */
    public function ratings(){
        return $this->hasMany("Rating");
    }
    
    /* Categories
     * Liên kết nhiều nhiều thông qua bảng post_category
     */
    public function categories(){
        return $this->belongsToMany("Category", "post_category");
    }
    
    /* comments
     * 
     */
    public function comments(){
        return $this->morphMany('Comment', 'commentable');
    }
    
    /* user
     * 
     */
    public function user(){
        return $this->belongsTo("User");
    }
   
    




    
}
