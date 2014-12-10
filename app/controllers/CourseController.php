<?php

class CourseController extends BaseController {
 
    public function viewAllCourse()
    {
        $courses = null;
        if(Auth::user()->isAdmin()){
            $courses = Course::with('instructors')->get();
        }
       /*
        if(Auth::user()->isManager()){
           
           $user_category = Auth::user()->categories()->get(array('categories.id'))->lists('id');

            $courses = Course::whereHas('categories', function($query){
                $user_category = Auth::user()->categories()->get(array('categories.id'))->lists('id');
                $query->whereIn('categories.id',$user_category);
            })->get()->toArray();
           
            
        }
        * 
        */

        return View::make('admin.courses.admin.view_all_course')->with(array(
            'courses'=> Course::with('instructors')->get(),
            'courses_trashed' => Course::onlyTrashed()->get()
            ));
        
    }
    
    public function getListChapter()
    {
        $chapters = Chapter::all(array('id','name'));
        
        $list = $chapters->lists('name', 'DisplayText');
        $list2 = $chapters->lists('id', 'Value');
        $options = array();
        foreach ($chapters as $chapter){
            $c = array('DisplayText'=>$chapter->name,'Value'=>$chapter->id);
            array_push($options, $c);
        }
   
        $data = array();
        $data['Result'] = 'OK';
        $data['Options'] = $options;
        return json_encode($data);
    }
    
    public function getCourseForm()
    {
        
        return View::make('admin.courses.new_course')->with(array(
            'course' => new Course(),
            'list_category' => Auth::user()->categories,
            'list_writer'   => User::where('role_id','=',2)->where('id','!=',Auth::id())->get()
            ));
   
    }
    
    public function updateCourse()
    {
          
        $course_id = Input::get('id');
        $course = Course::find($course_id);
        if($course) //nếu tồn tại course
        {
            if(Auth::user()->isOwnerOfCourse($course_id)) //nếu là chủ nhân của course thì được phép cập nhật thông tin course
            {
                $course->name = Input::get('name');
                $course->short_name = Input::get('short_name');
                $course->start_day = Input::get('start_day');
                $course->end_day = Input::get('end_day');
                $course->about_the_course = Input::get('about_the_course');

                $cover_image_url = Input::get('cover_image_url');
                if(!($course->cover_image_url == $cover_image_url)){

                    if(Input::hasFile('cover_image')){
                        $newFile = Input::file('cover_image');
                        FileController::deleteFile($course->cover_image_url);
                        $course->cover_image_url = FileController::getUrlFileUploaded($newFile,'uploads/courses/');
                    }   
                }


                $invited_writers = Input::get('writers');

                //return var_dump($invited_writers);
                $instructors = $course->instructors()->wherePivot('is_owner', '=', 0)->get(array('users.id'))->lists('id');
                $course->instructors()->detach($instructors);
                if($invited_writers){  
                    $course->instructors()->attach($invited_writers);
                }


                $categories = Input::get('categories');
                $course->categories()->detach();
                if($categories){
                    $course->categories()->attach($categories);
                }

                if($course->save()){
                    return Redirect::to(URL::current());
                        return Response::json(array(
                            'message'=>'Cập nhật thành công',
                        ));
                }
            }
            else 
            {
                return View::make('admin.message')->with('message', 'Bạn không có quyền cập nhật thông tin khóa học này!');
            }
        }

    }
    
    public function createCourse()
    { 
              
            $course = new Course();
            
            $course->name = Input::get('name');
            $course->short_name = Input::get('short_name');
            $course->start_day = Input::get('start_day');
            $course->end_day = Input::get('end_day');
            $course->about_the_course = Input::get('about_the_course'); 
            $course->status = 'pedding';
            
            if(Input::hasFile('cover_image')){
                 $file = Input::file('cover_image');
                 $course->cover_image_url = FileController::getUrlFileUploaded($file,'uploads/courses/');
            }
                   

            if($course->save()){
                $user_id = Input::get('user_id');
                $course->instructors()->attach($user_id,array('is_owner'=>1));
                
                $invited_writers = Input::get('writers');
                if($invited_writers){  
                    $course->instructors()->attach($invited_writers);
                }

                $categories = Input::get('categories');
                if($categories){
                  $course->categories()->attach($categories);
                }
                
                else{
                    $course->categories()->detach();
                }
                return Redirect::to('admin/course/edit/'.$course->id);
                
            }    
    }
    
    public function deleteCourse()
    {
        $id = Input::get('id');
       
        if(Course::find($id)->delete()){
            
            return 'xóa thành công';
        }
        else{
            return 'Thất bại';
        }
    }
    
    public function updateOrderOfChapter()
    {
        $course_id = Input::get('course_id');
        
        $order_list = Input::get('order_chapter');
        $order_list = json_decode($order_list);
        $i = 0;
 
        foreach($order_list as $item){
            Chapter::where('id','=',$item->id)->update(array('order_of_chapter'=>$i));
            $i++;
        }
        $chapters = Course::find($course_id)->chapters()->orderBy('order_of_chapter')->get();
        return Response::json(array(
            'html' =>  View::make('admin.courses._lecture_form', array('chapters'=>$chapters))->render(),
            'message' => 'cap nhat thanh cong'
        ));
    }
    
    
    public function destroy($course_id)
    {
        
        $course = Course::onlyTrashed()->find($course_id);
        
        $user = Auth::user();
        
        $course->forceDelete();
        return Redirect::to('admin/course');
    }
    
    public function getEdit($course_id)
    {
        
        $course = Course::find($course_id);
        if($course){
                if(Auth::user()->isEditableOfCourse($course_id)) //nếu là instructor của course
                {
                    $list_witer = User::where('role_id','=',2)->where('id','!=',  $course->owner()->id)->get();
                    return View::make('admin.courses.edit_course')->with(array(
                    'course'=> $course,
                    'list_category' => Auth::user()->categories,
                    'list_writer' => $list_witer
                    ));
                }
                else
                {
                    return View::make('admin.message')->with('message', 'Bạn không có quyền edit khóa học này');
                }
                

        }
        else{
          return View::make('admin.message')->with('message', 'Khóa học này không tồn tại!');
        } 
    }
}
