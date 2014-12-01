<?php

class CourseController extends BaseController {
 
    public function viewAllCourse()
    {
        return View::make('admin.courses.view_all_course')->with(array(
            'courses'=> Course::all(),
            'courses_trashed' => Course::onlyTrashed()->get()
            ));
    }
    
    public function getCourseForm()
    {
        return View::make('admin.courses.new_course');
   
    }
    
    public function updateCourse()
    {
        $course_id = Input::get('course-id');
        $course = Course::find($course_id);
        $course->name = Input::get('course-name');
        $course->short_name = Input::get('course-short_name');
        $course->start_day = Input::get('course-start_day');
        $course->end_day = Input::get('course-end_day');
        
        if($course->save()){
                return Response::json(array(
                    'message'=>'Cập nhật thành công',
                ));
        }
    }
    
    public function createCourse()
    { 
            $course = new Course();
            $course->name = Input::get('name');
            $course->short_name = Input::get('short_name');
            $course->start_day = Input::get('start_day');
            $course->end_day = Input::get('end_day');

            if($course->save()){
                
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
        return 'Cập nhật thành công';
    }
}
