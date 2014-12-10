<?php

class LectureController extends BaseController {
 
    public function addResource()
    {
         
        $lecture_id = Input::get('id');
        
        $count = Input::get('count');
        for($i=1;$i<=$count;$i++){
            $resource = new Resource();
            $resource->lecture_id = $lecture_id;
            $resource->resource_type_id = Input::get('resource_type_id'.$i);
            $method = Input::get('method'.$i);
            if($method==1)  //upload file
            {
                if(Input::hasFile('upload_file'.$i)){
                    $resource->path = FileController::getUrlFileUploaded(Input::file('upload_file'.$i),'uploads/lectures/');
                }
                
            }
            else if($method==2) //url
            {
                $resource->path = Input::get('path'.$i);
            }
            
            $resource->save();
        }
        return 'thanh cong';
        
        if(Input::hasFile('upload_file')){
            $files_array = array(Input::file('upload_file'));
            $files = $files_array[0];
            return FileController::getUrlFileUploaded($files[0],'uploads/lectures/');
            
            return 'tim thay file';
            
        }
        
        return var_dump($upload_file);
    }
    
    public function editLecture()
    {
        if(Request::ajax())
        {
            $chapter_id = Input::get('chapter_id');  
            if(Auth::user()->isOwnerOfChapter($chapter_id))
            {
                $lecture ;
                if(Input::get('action')=='create'){

                    if(Auth::user()->isOwnerOfChapter($chapter_id))
                    {
                        $lecture = new Lecture();
                        $lecture->chapter_id = $chapter_id;
                        $lecture->order_of_lecture = Lecture::where('chapter_id','=',$chapter_id)->count(); 
                    }
                    else
                    {
                        return Response::json(array(
                            'status' => 'invalid',
                            'message'  => 'Bạn không có quyền tạo lecture thuộc chapter này!'
                        ));
                    }
                }

                if(Input::get('action')=='update'){

                        $lecture = Lecture::find(Input::get('id'));       
                        Resource::where('lecture_id','=',$lecture->id)->delete();
                }

                $lecture->name = Input::get('name');

                if($lecture->save()){
                     return Response::json(array(
                            'status' => 'success',
                            'message' => 'Tạo thành công! Bạn hãy thêm tài nguyên cho lecture!',
                            'lecture_id' => $lecture->id
                     ));  
                }
            }
            else
            {
                if(Input::get('action')=='create'){
                    return Response::json(array(
                        'status' => 'invalid',
                        'message'  => 'Bạn không có quyền tạo lecture thuộc chapter này!'
                    ));
                }
                else if(Input::get('action')=='update'){
                    return Response::json(array(
                        'status' => 'invalid',
                        'message'  => 'Bạn không có quyền edit lecture thuộc chapter này!'
                    ));
                }
            } 
        }
    }
    
    public function deleteLecture()
    {
        if(Request::ajax())
        {
            $chapter_id = Input::get('chapter_id');
            if(Auth::user()->isOwnerOfChapter($chapter_id) || Auth::user()->isOwnerOfCourse(Chapter::find($chapter_id)->course_id))
            {
                $lecture_id = Input::get('lecture_id');
                if(Lecture::find($lecture_id)->delete()){
                    return Response::json(array(
                        'status' => 'success',
                        'message' => 'Delete lecture successful'
                    ));
                }
            }
            else
            {
               return Response::json(array(
                    'status' => 'invalid',
                    'message' => 'You unable delete this lecture'
                )); 
            }
        }
            
            
            
    }


     public function getEditForm()
     {
         $status = '';
         $message = '';
                 
            $lecture;
            if(Input::get('lecture_id')) //lấy form edit
            {
                $lecture = Lecture::find(Input::get('lecture_id'));
            }
            else  // trả về form create
            {
                $chapter_id = Input::get('chapter_id');
                
                $lecture = new Lecture();
                if($chapter_id){
                    $lecture->chapter_id = $chapter_id;
                }
               
            }
            
        if(Request::ajax()){
            
            if(Input::get('action')=='create')
            {
                if(Auth::user()->isOwnerOfChapter($chapter_id))
                {
                    return Response::json(array(
                        'status' => 'success',
                        'html'  => View::make('admin.courses._edit_lecture_form',array('lecture'=>$lecture))->render()
                    ));     
                    
                }
                else
                {
                    return Response::json(array(
                        'status' => 'invalid',
                        'message'  => 'Bạn không có quyền tạo lecture thuộc chapter này!'
                    ));   
                }
            }
            
        }
        else{
            return View::make('admin.courses._edit_lecture_form',array('lecture'=>$lecture));
        }
     }
     
     public function updateLecture()
     {
         $lecture = Lecture::find(Input::get('id'));
         $lecture->name = Input::get('name');
         if($lecture->save()){
             return 'thanh cong';
         }
     }
    

}
