@extends('admin.layouts.default')
@section('content')

<?php 
    $chapters = $course->chapters()->orderBy('order_of_chapter')->get();
    $chapters = Chapter::with('user')->where('course_id','=',$course->id)->get();
    $quizzes = Quiz::where('course_id','=',$course->id)->get();
?>

<div class="tabs-vertical-env">

    <ul class="nav tabs-vertical"><!-- available classes "right-aligned" -->
        <li class="active"><a href="#course-tab-content" data-toggle="tab">Course Info</a></li>
        <li class=""><a href="#chapter-tab-content" data-toggle="tab">Chapters</a></li>
        <li><a href="#lecture-tab-content" data-toggle="tab">Lectures</a></li>
        <li><a href="#quiz-tab-content" data-toggle="tab">Quizzes</a></li>
        <li><a href="#question-tab-content" data-toggle="tab">Questions</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="course-tab-content">   
          
            @include("admin.courses._course_form")
        </div>
        <div class="tab-pane" id="chapter-tab-content">
            @include("admin.courses._chapter_form")
        </div>
        <div class="tab-pane" id="lecture-tab-content">
            @include("admin.courses._lecture_form")
        </div>
        <div class="tab-pane" id="quiz-tab-content">
            @include("admin.courses._quiz_form")
        </div>
        
        <div class="tab-pane" id="question-tab-content">
            @include("admin.courses._question_form")
        </div>
    </div>

</div>


@stop

@section('scripts')


<!-- _course_form edit scripts validattion-->
<script>
 
jQuery.validator.addMethod("greaterThan", function(value, element, params) {
    if ($(params[0]).val() != '') {    
        if (!/Invalid|NaN/.test(new Date(value))) {
            return new Date(value) > new Date($(params[0]).val());
        }    
        return isNaN(value) && isNaN($(params[0]).val()) || (Number(value) > Number($(params[0]).val()));
    };
    return true; 
},'Must be greater than {1}.');

   $(document).ready(function(){
    

    $("#course_form").validate({
        rules : {
            name : {
                required : true,
                minlength:5
            },
            short_name : {
                required : true,
            },
            start_day:{
                required:true,
                date:true,
            },
            end_day:{
                required:true,
                date:true,
                greaterThan: ["#start_day","Start Day"]
            },
            categories:{
                required:true
            }
        },
        
       submitHandler: function(form) {
           
           form.submit();
        }
    });
    
});

</script>
<!-- end _course_form edit scripts -->



    @include('admin.courses._modal_form')
@stop
