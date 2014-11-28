<?php

use \CodeIsFun\Repositories\PostRepository;

class PostController extends BaseController{
    
    protected $postRepository;
    
    
    /**
     * inject the PostRepository
     * 
     * @param CodeIsFun\Repositories\PostsRepository $postRepository
     * @return void
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Return a listing of all Posts
     * 
     * @return View
     */
    public function index()
    {
        
        $posts = Post::all();
        return View::make('public.posts.index')->with('posts', $posts);
    }
    
    /**
     * Display a single post by id
     * 
     * @param string $categorySlug
     * @param string $slug
     * @return View
     */
    public function show($categorySlug, $slug)
    {
        $post = Post::where('categories.slug','=',$categorySlug)
                ->where('slug','=',$slug)
                ->first();
        if($post)
        {
            return View::make('public.posts.show')->with('post',$post);
        }
        else
        {
            App::abort(404);
        }
        
    }
    
    /**
     * Display the form to create a new post
     * 
     * @retrun View
     */
    public function create()
    {
        return View::make('admin.posts.create');
    }
    
    /**
     * Strore a new Post
     * 
     * @return Redirect
     */
    public function store()
    {
        $post = $this->postRepository->create(Input::all());
        if($post)
        {
            return Redirect::route('post.show',$post->id )->with('message' ,'bài viết đã được tạo thành công!');
            
        }
        else
        {
            Redirect::route('post.create')->withInput()->withErrors($this->postRepository->errors());
        }
    }

    /**
     * Display the form to edit an existing Post 
     * 
     * @param int $id
     * @return View
     */
    public function edit($id)
    {
        
         return View::make('admin.posts.edit');
         
        $post = $this->postRepository->find($id);
        if($post)
        {
            return View::make('admin.posts.edit',compact('post'));
        }
        else
        {
            App:abort(404);
        }
    }
    
    /**
     * Update an existring Post
     * 
     * @param int $id
     * @return Redirect
     */
    public function update($id)
    {
        $post = $this->postRepository->where('id','=',$id)
                ->update(Input::all());
        if($post)
        {
            return Redirect::route('admin.post.show', $id)->with('message', 'Cập nhật bài viết thành công!');
        }
        else
        {
            return Redirect::route('post.edit', $id)->withInput()->withErrors($this->postRepository->errors());
        }
    }
    
    /**
     * Display the form to delete a Post
     * 
     * @return View
     */
    public function delete($id)
    {
        $post = $this->postRepository->find($id);
        if($post)
        {
            return View::make('post.delete',  compact('post'));
        }
        else
        {
            App::abort(404);
        }
    }
    
    /**
     * Destroy a Post
     * 
     * @return Redirect
     */
    public function destroy($id)
    {
        $post = $this->postRepository->find($id);
        
        if($post)
        {
            return Redirect::route('post.index')->with('message', "Bài viết: '$post->title' đã được xóa");
        }
    }


}
