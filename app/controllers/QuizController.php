<?php

class QuizController extends BaseController {
 
    public function editQuiz()
    {
        if(Request::ajax())
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
                $quiz->user_id = Auth::id();

                if(Course::find($course_id)->quizzes()->save($quiz)){
                    $course = Course::find($course_id);

                    $quizzes = Quiz::where('course_id','=',$course->id)->get();

                    return Response::json(array(
                        'html' =>  View::make('admin.courses._question_form', array('quizzes'=>$quizzes))->render(),
                        'message' => 'Add new quiz successful',
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
                         'message' => 'Update Quiz successful',
                        ));
                };
            }
        }
        

    }
    
    public function deleteQuiz()
    {
        if(Request::ajax())
        {
            if($quiz_id = Input::get('quiz_id'))
            {
                $quiz = Quiz::find($quiz_id);
                if(Auth::user()->isOwnerOfQuiz($quiz_id) || Auth::user()->isOwnerOfCourse($quiz->course_id)){
                    if($quiz->delete()){
                        return Response::json(array(
                            'status' => 'success',
                            'message' => 'Delete Quiz successful'
                        ));
                    }
                    else
                    {
                        return Response::json(array(
                            'status' => 'invalid',
                            'message' => 'Error'
                        ));
                    }
                }
                else
                {
                    return Response::json(array(
                        'status' => 'invalid',
                        'message' => 'You unable delete this Quiz'
                    ));
                }
            }
            else // not find quiz_id
            {
                return Response::json(array(
                    'status' => 'invalid',
                    'message' => 'Unable find quiz_id'
                ));
            }
        }

    }
    
    

    public function getEditForm()
    {
        if(Request::ajax()){
            if(Input::get('action')=='update')
            {
                $course_id = (int)Input::get('course_id');
                if(Auth::user()->isEditableOfCourse($course_id))
                {
                    $quiz;
                    if($quiz_id = Input::get('quiz_id')){
                        $quiz = Quiz::find($quiz_id);
                    }
                    
                    return Response::json(array(
                        'status' => 'success',
                        'html' => View::make('admin.courses._edit_quiz_form',array('quiz'=>$quiz))->render()
                    ));
                }
                else
                {
                    return Response::json(array(
                        'status' => 'invalid',
                        'message' => 'Bạn không có edit Quiz này!'
                    ));
                }
            }
            else  //action = create
            {
                 $quiz= new Quiz();
                 return Response::json(array(
                        'status' => 'success',
                        'html' => View::make('admin.courses._edit_quiz_form',array('quiz'=>$quiz))->render()
                 ));
            }
            
        }
    }
    
    public function updateQuiz()
    {
        
            
            

    }
}
