<?php
use LaravelBook\Ardent\Ardent;


class Post extends Ardent {
    
    use Illuminate\Database\Eloquent\SoftDeletingTrait;
    
    protected $dates = ['deleted_at'];
    protected $softDelete = true; 
    protected $table = "posts";
    protected $guarded = array();
    protected $fillable = array('user_id','slug','title','cover_image_url',
        'description','post_status_id','content','public_time');
    
    
    /**
    * Ardent validation rules
    */
    public static $rules = array(
        'title'       => 'required',
        'cover_image_url'   => 'url',
        'description'       => 'required',
        'content'           => 'required',
        
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
        return $this->belongsTo("Status","status_id");
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
