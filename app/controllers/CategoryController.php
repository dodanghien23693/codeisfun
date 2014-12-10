<?php

class CategoryController extends BaseController {
     public function __construct()
    {
       if(Auth::user())
       {
        if(Auth::user()->role->name=="Manager" || Auth::user()->role->name=="Admin")
        {

        }
        else
        {
            echo "Wrong Site";
         die();
        }
       }
    }//
    public function getCategoryContent()
    {

        return View::make('admin.categories._category')->with(array('categories'=> Category::getList()));
    }
    
    public function updateOrderCategory()
    {
        $list = Input::get('data');
        $i=0;
        $list = json_decode($list);
        foreach($list as $item){
            Category::where('id','=',$item->id)->update(array('order_of_category'=>$i));
            $i++;
        }
        return 'Cập nhật thành công';
        
        
    }
    
    public function createCategory()
    {

        $cate = new Category();
        $cate->name = Input::get('name');
        $cate->slug = Input::get('slug');
        $cate->description = Input::get('description');
        $cate->order_of_category = Category::all()->count()  ;
        
        if($cate->save()){
            return Response::json(array(
                'html' => '',
                'message' => 'thêm thành công',
                'category_id' => $cate->id,
            ));
 
        }
        return false;
    }
    
    public function deleteCategory()
    {
        $category_id = Input::get('category_id');
        if(Category::find($category_id)->delete()){
            return 'Thanh cong';
        }
    }
    

}
