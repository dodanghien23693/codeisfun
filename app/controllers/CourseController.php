<?php

class CourseController extends BaseController {
 
    public function index($id)
    {
        return 'welcome course '.Course::find($id)->name;
    }

    public function getAcceptBecomeCreator($course_id)
    {
        
            $course = Auth::user()->createdCourses()->wherePivot('course_id', '=', $course_id)->wherePivot('is_active', '=', 0)->first();
            
       if(count($course))return View::make('admin/courses/_accept_invitation')->with('course', $course);
        
        else return Redirect::to('admin/course');
        
        
        //return var_dump($course->pivot->user_id);
        
    
    }

    public function viewAllCourse()
    {
        $courses = null;
        if(Auth::user()->isAdmin()){
            $courses = Course::with('instructors')->get();
        }
       
        if(Auth::user()->isManager()){
            $user_category = Auth::user()->categories()->get(array('categories.id'))->lists('id');
            $courses = Course::whereHas('categories', function($query){
                $user_category = Auth::user()->categories()->get(array('categories.id'))->lists('id');
                $query->whereIn('categories.id',$user_category);
            })->get();
        }

        if(Auth::user()->isWriter()){
            $courses = Course::whereHas('instructors', function($q){
                $q->where('user_id','=',Auth::id());
            })->get();
        }
        
        
        return View::make('admin.courses.view_all_course')->with(array(
            'courses'=> $courses,
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


                $invited_writers = Input::get('writers'); //Danh sách người cùng tham gia khóa học
                if(!$invited_writers) $invited_writers = array();
                
                // lấy danh sách id những người cùng tham khóa khóa học nhưng không phải là chủ khóa học
                $instructors = $course->instructors()->wherePivot('is_owner', '=', 0)->get(array('users.id'))->lists('id');
                if(!$instructors) $instructors = array();
                
                $no_change = array_intersect($invited_writers, $instructors);
                
                $merge_invited = array_merge($instructors,$invited_writers);
                
                foreach ($merge_invited as $invi)
                {
                    if(in_array($invi, $invited_writers) && !in_array($invi, $no_change))  //Nếu là người mới được thêm vào thì gửi lời mời
                    {
                        $course->notificationInviteWriter($invi);
                        $course->instructors()->attach($invi,array('is_active'=>0));
                    }
                    
                    
                    if(in_array($invi, $instructors) && !in_array($invi, $no_change))
                    {
                        $course->notificationRemoveWriter($invi);
                        $course->instructors()->detach($invi);
                    }
                }
                
                
                //Lưu danh mục
                $categories = Input::get('categories');
                $course->categories()->detach();
                if($categories){
                    $course->categories()->attach($categories);
                }
                
                
                if($course->save()){
                    
                    $course->notificationUpdate();
                   
                    return Redirect::to(URL::current());
                        return Response::json(array(
                            'message'=>'Cập nhật thành công',
                        ));
                }
            }
            else //Không phải là chủ nhân của course
            {
                return View::make('admin.message')->with('message', 'You unable edit general information of this course!');
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
                $course->instructors()->attach($user_id,array('is_owner'=>1,'is_active'=>1));
                
                $invited_writers = Input::get('writers');
                if($invited_writers){
                    //$course->notificationInviter($invited_writers);
                    $course->instructors()->attach($invited_writers,array('is_active'=>0));
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
    
    public function acceptInvitation($course_id)
    {
        if($course_id){
           if(Request::ajax())
            {
                Auth::user()->createdCourses()->wherePivot('course_id','=',$course_id)->updateExistingPivot($course_id, array('is_active'=>1));
                return Response::json(array(
                    'status' => 'success',
                    'message' => 'you had became instructor of course :'.$course_id
                ));
            } 
        }

    }
    

    public function rejectInvitation($course_id)
    {
        Auth::user()->createdCourses()->detach($course_id);
    }
    
    public function deleteCourse()
    {
        
        $course_id = Input::get('id');
        
        if(Auth::user()->isDeleteAbleOfCourse($course_id))
        {
            if(Course::find($course_id)->delete()){
            
                return Response::json(array(
                 'status' => 'success',
                 'message' => 'Delete course successful'
                ));
                
            }
            
        }
        else
        {
            return Response::json(array(
                'status' => 'invalid',
                'message' => 'You unable delete this course'
            ));
        }
        
    }
    
    public function updateOrderOfChapter()
    {
        $course_id = Input::get('course_id');
        
        if(Auth::user()->isOwnerOfCourse($course_id))
        {
            $order_list = Input::get('order_chapter');
            $order_list = json_decode($order_list);
            $i = 0;

            foreach($order_list as $item){
                Chapter::where('id','=',$item->id)->update(array('order_of_chapter'=>$i));
                $i++;
            }
            $chapters = Course::find($course_id)->chapters()->orderBy('order_of_chapter')->get();
            return Response::json(array(
                'status' => 'success',
                'html' =>  View::make('admin.courses._lecture_form', array('chapters'=>$chapters))->render(),
                'message' => 'Update order successful'
            ));
        }
        else
        {
            return Response::json(array(
                'status' => 'invalid',
                'message' => 'You unable update order of chapter in this course'
            ));
        }
        
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
