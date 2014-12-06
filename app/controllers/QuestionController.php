<?php

class QuestionController extends BaseController {
 
    public function editQuestion()
    {
        $question ;
        
        if(Input::get('action')=='create'){
            
            $quiz_id = Input::get('quiz_id');  
            $question = new Question();
            $question->quiz_id = $quiz_id;
            $question->order_of_question = Question::where('quiz_id','=',$quiz_id)->count();  
            
        }

        if(Input::get('action')=='update'){
            $question = Question::find(Input::get('question_id'));       
            Answer::where('question_id','=',$question->id)->delete();
            
        }
        
        $question->question = Input::get('question');
        $question->question_type_id = Input::get('question_type_id');
        
       
        if($question->save()){
            
                $list_answer = json_decode(Input::get('list_answer'),true);
                
                foreach($list_answer as  $order => $answer)
                {
                    $a = new Answer();
                    $a->question_id = $question->id;
                    $a->answer = $answer['answer'];
                    $a->is_right_answer = ($answer['checked']=='checked')?1:0;
                    $a->order_of_answer = $order;
                    $a->save();
                    
                }
                
                return Response::json(array(
                    'question_id' => $question->id
                    
                ));           
        }
        
    }
    
    public function deleteQuestion()
    {
        $question_id = Input::get('question_id');
        
        if(Question::find($question_id)->delete()){
            return "xoa thanh cong";
        }
        
        return false;
    }
    
  
    public function updateOrderOfQuestion()
    {
        $quiz_id = Input::get('quiz_id');
        
        $order_list = Input::get('order_question');
        $order_list = json_decode($order_list);
        $i = 0;
 
        foreach($order_list as $item){
            Question::where('id','=',$item->id)->update(array('order_of_question'=>$i));
            $i++;
        }
        return 'Cập nhật thành công';
    }
    
    public function getEditForm()
     {   
            $quiz_id = Input::get('quiz_id');
            $question;
            $action ='';
            if(Input::get('question_id')){
                $question = Question::find(Input::get('question_id'));
                
            }
            
            else{
                $question = new Question();
                $question->question_type_id = 1;
                $question->quiz_id = Input::get('quiz_id');
            }
            return  View::make('admin.courses._edit_question_form',array('question'=>$question))->render();
     }
     
     

}
