<?php

class QuizController extends BaseController {
 
    public function editQuiz()
    {
        if(Input::get('action')=='create'){
            $course_id = Input::get('course_id');
            $quiz = new Quiz();
            $quiz->name = Input::get('name');
            $quiz->duration_minus = Input::get('duration_minus');
            $quiz->max_attempts = Input::get('max_attempts');
            $quiz->due_date = Input::get('due_date');
            $quiz->hard_deadline = Input::get('hard_deadline');
            $quiz->description = Input::get('description');
            
            if(Course::find($course_id)->quizzes()->save($quiz)){
                $course = Course::find($course_id);
                
                $quizzes = Quiz::where('course_id','=',$course->id)->get();
                
                return Response::json(array(
                    'html' =>  View::make('admin.courses._question_form', array('quizzes'=>$quizzes))->render(),
                    'message' => 'Thêm thành công',
                    'quiz_id' => $quiz->id,
                    ));
            };
            
        }
        else if(Input::get('action')=='update'){
            $quiz_id = Input::get('id');
            
            $quiz = Quiz::find($quiz_id);
            
            $quiz->name = Input::get('name');
            $quiz->duration_minus = Input::get('duration_minus');
            $quiz->max_attempts = Input::get('max_attempts');
            $quiz->due_date = Input::get('due_date');
            $quiz->hard_deadline = Input::get('hard_deadline');
            $quiz->description = Input::get('description');
             
            if($quiz->save()){               
                return Response::json(array(
                     'message' => 'Thêm thành công',
                    ));
            };
        }

    }
    
    public function deleteQuiz()
    {
        $quiz_id = Input::get('quiz_id');
        
        if(Quiz::find($quiz_id)->delete()){
            return "xoa thanh cong";
        }
        return false;
    }
    
    

    public function getEditForm()
    {
        if(Request::ajax()){
            $quiz;
            if($quiz_id = Input::get('quiz_id')){
                $quiz = Quiz::find($quiz_id);
            }
            else{
                $quiz= new Quiz();
            };
            
            return View::make('admin.courses._edit_quiz_form',array('quiz'=>$quiz))->render();
        }
    }
    
    public function updateQuiz()
    {
        
            
            

    }
}
