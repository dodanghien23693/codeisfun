<?php



class TagController extends BaseController{
    
   
   

    /**
     * Return a listing of all Tags
     * 
     * @return View
     */
    public function index()
    {
        
        $tags = Tag::all();
        return View::make('admin.tags.index',  compact("tags"));
    }
    
    /**
     * Display a single tag by id
     * 
     * @param string $categorySlug
     * @param string $slug
     * @return View
     */
    public function show($id)
    {
        $tag = Tag::find($id);
        if($tag)
        {
            return View::make('admin.tags.show')->with('tag',$tag);
        }
        else
        {
            App::abort(404);
        }
        
    }
    
    /**
     * Display the form to create a new tag
     * 
     * @retrun View
     */
    public function create()
    {
        return View::make('admin.tags.create');
    }
    
    /**
     * Strore a new Tag
     * 
     * @return Redirect
     */
    public function store()
    {
        $tag = Tag::create(Input::all());
        if($tag)
        {
            return Redirect::route('tag.show',$tag->id )->with('message' ,'bài viết đã được tạo thành công!');
            
        }
        else
        {
            Redirect::route('tag.create')->withInput()->withErrors($this->tagRepository->errors());
        }
    }

    /**
     * Display the form to edit an existing Tag 
     * 
     * @param int $id
     * @return View
     */
    public function edit($id)
    {
        
         //return View::make('admin.tags.edit');
         
        $tag = Tag::find($id);
        if($tag)
        {
            return View::make('admin.tags.edit',compact('tag'));
        }
        else
        {
            App:abort(404);
        }
    }
    
    /**
     * Update an existring Tag
     * 
     * @param int $id
     * @return Redirect
     */
    public function update($id)
    {
        $tag =Tag::where('id','=',$id)
                ->update(Input::all());
        if($tag)
        {
            return Redirect::route('admin.tag.show', $id)->with('message', 'Cập nhật bài viết thành công!');
        }
        else
        {
            return Redirect::route('tag.edit', $id)->withInput()->withErrors($this->tagRepository->errors());
        }
    }
    
    /**
     * Display the form to delete a Tag
     * 
     * @return View
     */
    public function delete($id)
    {
        $tag = Tag::find($id);
        if($tag)
        {
            return View::make('tag.delete',  compact('tag'));
        }
        else
        {
            App::abort(404);
        }
    }
    
    /**
     * Destroy a Tag
     * 
     * @return Redirect
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        
        if($tag)
        {
            $tag->delete();
            return Redirect::route('tag.index')->with('message', "Tag '$tag->name' đã được xóa");
        }
    }


}
