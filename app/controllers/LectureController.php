<?php

class LectureController extends BaseController {
 
    public function editLecture()
    {
             
        $lecture ;
        
        if(Input::get('action')=='create'){
            
            $chapter_id = Input::get('chapter_id');  
            $lecture = new Lecture();
            $lecture->chapter_id = $chapter_id;
            $lecture->order_of_lecture = Lecture::where('chapter_id','=',$chapter_id)->count();  
        }

        if(Input::get('action')=='update'){
            $lecture = Lecture::find(Input::get('id'));       
            Resource::where('lecture_id','=',$lecture->id)->delete();
            
        }
        
        
        $lecture->name = Input::get('name');
        
        if($lecture->save()){
            
                $list_resource = json_decode(Input::get('list_resource'),true);
                
                foreach($list_resource as  $resource)
                {
                    
                    $r = new Resource();
                    $r->lecture_id = $lecture->id;
                    $r->path = $resource['path'];
                    $r->resource_type_id = $resource['resource_type_id'];
                    $r->save();
                    
                }           
                return Response::json(array(
                    'lecture_id' => $lecture->id
                    
                ));           
        }
        return false;
    }
    
    public function deleteLecture()
    {
        $lecture_id = Input::get('lecture_id');
        
        if(Lecture::find($lecture_id)->delete()){
            return "xoa thanh cong";
        }
        return false;
    }
    

     public function getEditForm()
     {
        if(Request::ajax()){
            $lecture;
            if(Input::get('lecture_id')) //lấy form edit
            {
               
                $lecture = Lecture::find(Input::get('lecture_id'));
            }
            else  // trả về form create
            {
                $chapter_id = Input::get('chapter_id');
                $lecture = new Lecture();
                $lecture->chapter_id = $chapter_id;
               
            }
            
            return View::make('admin.courses._edit_lecture_form',array('lecture'=>$lecture))->render();
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
