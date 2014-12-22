<?php

class ChapterController extends BaseController {
 
    public function createChapter()
    {
        if(Request::ajax())
        {
            $course_id = Input::get('course_id');
            
            $chapter = new Chapter();
            $chapter->name = Input::get('name');
            $chapter->order_of_chapter = Chapter::where('course_id','=',$course_id)->count();
            $chapter->user_id = Auth::id();
         
            if(Course::find($course_id)->chapters()->save($chapter)){
                $course = Course::find($course_id);
                $chapters = $course->chapters()->orderBy('order_of_chapter')->get();
                
                return Response::json(array(
                    'status' => 'success',
                    'html' =>  View::make('admin.courses._lecture_form', array('chapters'=>$chapters))->render(),
                    'message' => 'Create new chapter successful',
                    'chapter_id' => $chapter->id,
                    ));
            };
        }
           
    }
    
    public function deleteChapter()
    {
        if(Request::ajax())
        {
            $status = '';
            $message = '';
            
            $chapter_id = (int)Input::get('chapter_id');
            $chapter = Chapter::find($chapter_id);
            if($chapter)
            {
                //Nếu là người tạo ra chapter hoặc là chủ của course
                if(($chapter->user_id == Auth::id()) || Auth::user()->isOwnerOfCourse($chapter->course_id))
                { 
                    if($chapter->delete())
                    {
                            $status = 'success';
                            $message = 'Delete successful!';
                    }
                    else
                    {
                        $status = 'success';
                        $message = 'Delete failed';
                    }
                    
                }
                else
                {
                    $status = 'invalid';
                    $message = 'You unable delete this chapter';
                }
            }
            
            return Response::json(array(
                'status' => $status,
                'message' => $message
            ));
        }//end ajax request
        
         return ';';
    }
    
    public function updateOrderOfLecture()
    {
        if(Request::ajax())
        {
            
            $chapter_id = Input::get('chapter_id');
            if(Auth::user()->isOwnerOfChapter($chapter_id))
            {
                $order_list = Input::get('order_lecture');
                $order_list = json_decode($order_list);
                $i = 0;

                foreach($order_list as $item){
                    Lecture::where('id','=',$item->id)->update(array('order_of_lecture'=>$i));
                    $i++;
                }
                return Response::json(array(
                    'status' => 'success',
                    'message' => 'Update order of lecture in this chapter successful'
                ));
            }
            else
            {
                return Response::json(array(
                    'status' => 'invalid',
                    'message' => 'You unable update order lecture of this chapter'
                ));
            }
            
        }
        
    }

    public function getEditChapterForm()
    {
        if(Request::ajax()){
            
            $chapter_id = (int) Input::get('chapter_id');
            $chapter = Chapter::find($chapter_id);
            if($chapter){
                if(Auth::user()->isOwnerOfChapter($chapter_id))
                {
                    return Response::json(array(
                        'status' => 'success',
                        'html'  => View::make('admin.courses._edit_chapter_form',array('chapter'=>$chapter))->render()
                    ));
                }
                else //Nếu không phải là người tạo ra chapter
                {
                    return Response::json(array(
                        'status' => 'invalid',
                        'message'  => 'You unable edit this Chapter'
                    ));
                }
            }
        }
    }
    
    public function getCreateChapterForm()
    {
        return View::make('admin.courses._create_chapter_form');
        
    }
    
    public function updateChapter()
    {
        if(Request::ajax())
        {
            $chapter = Chapter::find(Input::get('id'));
            $chapter->name = Input::get('name');
            if($chapter->save()){
                return Response::json(array(
                    'status' => 'success',
                    'message' => 'Update chapter successful'
                ));
            }
        }

    }
    
}
