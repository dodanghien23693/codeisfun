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
        if(Request::ajax())
        {
            if($quiz_id = Input::get('quiz_id'))
            {
                if(Auth::user()->isOwnerOfQuiz($quiz_id) || Auth::user()->isOwnerOfCourse(Quiz::find($quiz_id)->course_id))
                {
                    if($question_id = Input::get('question_id'))
                    {
                        if($question = Question::find($question_id))
                        {
                            $question->delete();
                            return Response::json(array(
                                'status' => 'success',
                                'message' => 'delete question successful'
                            ));
                        }
                        else
                        {
                            return Response::json(array(
                                'status' => 'invalid',
                                'message' => 'Unable fine question'
                            ));
                        }
                    }
                }
                else // unable delete question
                {
                    return Response::json(array(
                        'status' => 'invalid',
                        'message' => 'Yout unable delete this question'
                    ));
                }
            }
            else
            {
                return Response::json(array(
                    'status' => 'invalid',
                    'message' => 'Yout unable delete this quiz'
                ));
            }
        }

    }
    
 
    public function updateOrderOfQuestion()
    {
        if(Request::ajax())
        {
            $quiz_id = Input::get('quiz_id');
            if( Auth::user()->isOwnerOfQuiz($quiz_id) )
            {
                $order_list = Input::get('order_question');
                $order_list = json_decode($order_list);
                $i = 0;
                foreach($order_list as $item){
                    Question::where('id','=',$item->id)->update(array('order_of_question'=>$i));
                    $i++;
                }
                return Response::json(array(
                    'status' => 'success',
                    'message' => 'Update order_of_question successful'
                ));
            }   
            else
            {
                return Response::json(array(
                    'status' => 'invalid',
                    'message' => 'You unable do this action'
                ));
            }
        }
    }
    
    public function getEditForm()
     {   
        if(Request::ajax())
        {
            if(Input::get('action')=='update')
            {
                if($quiz_id = Input::get('quiz_id'))
                {
                    if(Auth::user()->isOwnerOfQuiz($quiz_id))
                    {
                        if($question_id = Input::get('question_id')){
                            $question = Question::find($question_id);
                            return Response::json(array(
                                'status' => 'success',
                                'html'  => View::make('admin.courses._edit_question_form',array('question'=>$question))->render()
                            ));
                        }
                    }
                    else //Không phải là người tạo ra Quiz này
                    {
                        return Response::json(array(
                            'status' => 'invalid',
                            'message'  => 'You unable edit question for this Quiz!'
                        ));
                    }
                } 
            }
            if(Input::get('action')=='create')
            {
                 if($quiz_id = Input::get('quiz_id'))
                 {
                   
                    if(Auth::user()->isOwnerOfQuiz($quiz_id))
                    {
                        $question = new Question();
                        $question->question_type_id = 1;
                        $question->quiz_id = Input::get('quiz_id');
                        return Response::json(array(
                            'status' => 'success',
                            'html'  => View::make('admin.courses._edit_question_form',array('question'=>$question))->render()
                        ));
                    }
                    else
                    {
                        return Response::json(array(
                            'status' => 'invalid',
                            'message'  => 'You unable create question for this Quiz!'
                        ));
                    }
                 }
            }
        }
     }
     
     

}
