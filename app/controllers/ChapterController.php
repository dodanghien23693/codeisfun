<?php

class ChapterController extends BaseController {
 
    public function createChapter()
    {
            $course_id = Input::get('course_id');
            
            $chapter = new Chapter();
            $chapter->name = Input::get('name');
            $chapter->order_of_chapter = Chapter::where('course_id','=',$course_id)->count();
           
         
            if(Course::find($course_id)->chapters()->save($chapter)){
                $course = Course::find($course_id);
                $chapters = $course->chapters()->orderBy('order_of_chapter')->get();
                
                return Response::json(array(
                    'html' =>  View::make('admin.courses._lecture_form', array('chapters'=>$chapters))->render(),
                    'message' => 'Thêm thành công',
                    'chapter_id' => $chapter->id,
                    ));
            };
           
    }
    
    public function deleteChapter()
    {
        $chapter_id = Input::get('chapter_id');
        
        if(Chapter::find($chapter_id)->delete()){
            return "xoa thanh cong";
        }
        return false;
    }
    
    public function updateOrderOfLecture()
    {
        $chapter_id = Input::get('chapter_id');
        
        $order_list = Input::get('order_lecture');
        $order_list = json_decode($order_list);
        $i = 0;
 
        foreach($order_list as $item){
            Lecture::where('id','=',$item->id)->update(array('order_of_lecture'=>$i));
            $i++;
        }
        return 'cap nhat thanh cong';
    }

    public function getEditChapterForm()
    {
        if(Request::ajax()){
            $chapter_id = Input::get('chapter_id');
            $chapter = Chapter::find($chapter_id);
            return View::make('admin.courses._edit_chapter_form',array('chapter'=>$chapter))->render();
        }
    }
    
    public function getCreateChapterForm()
    {
        return View::make('admin.courses._create_chapter_form');
        
    }
    
    public function updateChapter()
    {
        $chapter = Chapter::find(Input::get('id'));
        $chapter->name = Input::get('name');
        if($chapter->save()){
            return 'thanh cong';
        }
        
    }
    
}
