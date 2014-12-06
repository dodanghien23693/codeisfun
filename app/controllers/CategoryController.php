<?php

class CategoryController extends BaseController {
 
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
    
    public function getEditCategoryForm()
    {
        if(Request::ajax()){
            $category_id = Input::get('category_id');
            $category = Category::find($category_id);
            return View::make('admin.categories._edit_category_form',array('category'=>$category))->render();
        }
    }
    
    public function updateCategory()
    {
        if(Request::ajax()){
            $category_id = Input::get('category_id');
            $category = Category::find($category_id);
            $category->name = Input::get('name');
            $category->slug = Input::get('slug');
            $category->description = Input::get('description');
            if($category->save()){
                return Response::json(array(
                    'message'=>'thanh cong',

                ));
            }
        }
    }
    

}
