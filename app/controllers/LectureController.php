<?php

class LectureController extends BaseController {
 
    public function createLecture()
    {
        
        $chapter_id = Input::get('chapter_id');  
            $lecture = new Lecture();
            $lecture->name = Input::get('lecture_name');
            $lecture->order_of_lecture = Lecture::where('chapter_id','=',$chapter_id)->count();
            
            
            if(Chapter::find($chapter_id)->lectures()->save($lecture)){
                return Response::json(array(
                    'html' => '',
                    'message' => 'Thêm thành công',
                    'lecture_id' => $lecture->id,
                    ));
            };
    }
    
    public function deleteLecture()
    {
        $lecture_id = Input::get('lecture_id');
        
        if(Lecture::find($lecture_id)->delete()){
            return "xoa thanh cong";
        }
        return false;
    }
    
    public function getCreateLectureForm()
    {
        if(Request::ajax()){
            $chapter_id = Input::get('chapter_id');
            return View::make('admin.courses._create_lecture_form',array('chapter_id'=>$chapter_id))->render();
        }
    }
    

}
