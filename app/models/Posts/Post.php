<?php
use LaravelBook\Ardent\Ardent;
/**
 * Post
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Tag[] $tags
 * @property-read \Status $status
 * @property-read \Visibility $visibility
 * @property-read \Illuminate\Database\Eloquent\Collection|\Rating[] $ratings
 * @property-read \Illuminate\Database\Eloquent\Collection|\Category[] $categories
 * @property-read \Illuminate\Database\Eloquent\Collection|\Comment[] $comments
 * @property-read \User $user
 * @property integer $id
 * @property integer $user_id
 * @property string $slug
 * @property string $title
 * @property string $cover_image_url
 * @property string $description
 * @property string $content
 * @property integer $post_status_id
 * @property integer $post_visibility_id
 * @property string $public_time
 * @property integer $view_count
 * @property integer $comment_count
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at

 */

class Post extends Ardent {
    
    use Illuminate\Database\Eloquent\SoftDeletingTrait;
    
    protected $dates = ['deleted_at'];
    
    protected $table = "posts";
    
    protected $fillable = array('slug','title','cover_image_url',
        'description','content','public_time','view_count','comment_count');
    
    
    /**
    * Ardent validation rules
    */
    public static $rules = array(
        'title'       => 'required',
        'slug'        => 'required|unique:posts,slug',  
        'cover_image_url'   => 'url',
        'description'       => 'required|min:100',
        'content'           => 'required|min:200',
        
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
        return $this->belongsTo("User",'user_id');
    }
    
    




    
}
