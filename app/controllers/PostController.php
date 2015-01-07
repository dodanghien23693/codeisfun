<?php



class PostController extends BaseController {


    /**
     * Return a listing of all Posts
     * 
     * @return View
     */
    public function __construct()
    {
       if(Auth::user())
       {
        if(Auth::user()->isManager() || Auth::user()->isAdmin()||Auth::user()->isWriter())
        {

        }
        else
        {
            echo "Wrong Site";
         die();
        }
       }
    }//
    public function index() {


        $posts = Post::all();
        if(Auth::check())
        {
            if(Auth::user()->isAdmin()){};
            if(Auth::user()->isManager()){};
            if(Auth::user()->isWriter()){
                $posts=Auth::user()->posts()->paginate(10);
            }
        }
        //$posts=Post::where('id','>','0')->get();
        return View::make('admin.posts.index', compact("posts"));
    }

    /**
     * Display a single post by id
     * 
     * @param string $categorySlug
     * @param string $slug
     * @return View
     */
    public function show($id) {
        $post = Post::find($id);
        if ($post) {
            return View::make('admin.posts.show')->with('post', $post);
        } else {
            App::abort(404);
        }
    }

    /**
     * Display the form to create a new post
     * 
     * @retrun View
     */
    public function create() {
       if(Auth::user())
       {
        if(Auth::user()->isManager() || Auth::user()->isAdmin()||Auth::user()->isWriter())
        {
                return View::make('admin.posts.create');    
        }
        else
        {
            echo "Wrong Site";
         die();
        }
       }
    }

    /**
     * Strore a new Post
     * 
     * @return Redirect
     */
    public function store() {
        $input = array_except(Input::all(), array('_method', '_token', 'cover_image_file','post_category','post_tag'));
                $post = new Post();
                
                $post->user_id = Auth::user()->id;
                $post->title = Input::get('title');
                $post->slug = Input::get('slug');
                $post->description = Input::get('description');
                $post->content = Input::get('content');
                $post->post_status_id = Input::get('post_status_id');
                $post->public_time = Input::get('public_time');
                
               
        if ($post->save()) {

                $post->tags()->sync(array_merge(array(),(array)Input::get('post_tag')));

                $post->categories()->sync(array_merge(array(),(array)Input::get('post_category')));
                $post->save();
            if (Input::hasFile('cover_image_file')) {
                $file = Input::file('cover_image_file');
                $destinationPath = public_path() . '/img/';
                $assetPath = '/img/';
                $filename = str_random(6) . '_' . $file->getClientOriginalName();
                $uploadSuccess = $file->move($destinationPath, $filename);
                Post::where('id', '=', $post->id)->update(array('cover_image_url' => $assetPath . '/' . $filename));
            }

            return Redirect::route('admin.post.show', $post->id)->with('message', 'bài viết đã được tạo thành công!');
        } else {
            return Redirect::route('admin.post.create')->withInput()->withErrors(Post::errors());
        }
    }

    /**
     * Display the form to edit an existing Post 
     * 
     * @param int $id
     * @return View
     */
    public function edit($id) {

      if(Auth::user())
       {
        if(Auth::user()->isManager() ||Auth::user()->isWriter())
        {

        }
        else
        {
            echo "Wrong Site";
         die();
        }
       }

        $post = Post::find($id);
        if ($post) {
            if(Auth::user()->isWriter())
            {
                if($post->user->id!==Auth::user()->id){die("Wrong Site");}
            }
            return View::make('admin.posts.edit', compact('post'));
        } else {
           dd($post);
        }
    }

    /**
     * Update an existring Post
     * 
     * @param int $id
     * @return Redirect
     */
    public function update($id) {
        $input = array_except(Input::all(), array('_method', '_token', 'cover_image_file','post_category','post_tag'));
        
        $post = Post::find($id);
                $post->update($input);

        $post->tags()->sync(array_merge(array(),(array)Input::get('post_tag')));

        $post->categories()->sync(array_merge(array(),(array)Input::get('post_category')));
        $post->save();
        if ($post) {
            if (Input::hasFile('cover_image_file')) {
                $file = Input::file('cover_image_file');
                $destinationPath = public_path() . '/img/';
                $assetPath = '/img/';
                $filename = str_random(6) . '_' . $file->getClientOriginalName();
                $uploadSuccess = $file->move($destinationPath, $filename);
                Post::where('id', '=', $id)->update(array('cover_image_url' => $assetPath . '/' . $filename));
            }
            return Redirect::route('admin.post.index')->with('message', 'Cập nhật bài viết thành công!');
        } else {

            return Redirect::route('admin.post.edit', $id)->withInput()->withErrors(Post::errors());
        }
    }

    /**
     * Display the form to delete a Post
     * 
     * @return View
     */
    public function delete($id) {
        $post = Post::find($id);
        if ($post) {
            return View::make('post.delete', compact('post'));
        } else {
            App::abort(404);
        }
    }

    /**
     * Destroy a Post
     * 
     * @return Redirect
     */
    public function destroy($id) {
        $post = Post::find($id);

        if ($post) {
            $post->delete();
            
            return Redirect::route('admin.post.index')->with('message', "Bài viết: '$post->title' đã được xóa");
        }
    }
    public function getPending()
    {
        if(Auth::user())
       {
        if(Auth::user()->isManager())
        {

        }
        else
        {
            echo "Wrong Site";
         die();
        }
       }
         $posts = Post::where('post_status_id',2)->paginate(10);
        
        return View::make('admin.posts.pending', compact("posts"));
    }
   
   public function getPendingPost($id) {
    if(Auth::user())
       {
        if(Auth::user()->isManager())
        {

        }
        else
        {
            echo "Wrong Site";
         die();
        }
       }
        $post = Post::find($id);
        if ($post) {
            return View::make('admin.posts.show_admin')->with('post', $post);
        } else {
            App::abort(404);
        }
    }

}
