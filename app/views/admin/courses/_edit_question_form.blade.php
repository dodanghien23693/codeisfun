<?php
 if ($question->question_type_id == 1) $type = 'radio';
 else $type = 'checkbox';
 
 $answers = $question->answers()->orderBy('order_of_answer')->get();
?>

<form id='question-form-modal' class="form-horizontal" role="form">
    <input name="question_id" type="hidden" value="{{$question->id}}">
    <input name="quiz_id" type="hidden" value="{{$question->quiz_id}}">
   
    <div class="form-group ">
        <label for="question_type_id"  class="control-label col-sm-4">Question Type</label>
        <div class="col-sm-8">
            <select name="question_type_id" class="form-control" >
                <option value="1" <?php if($type=='radio')  echo 'selected'; ?>>Select one</option>
                <option value="2" <?php if($type=='checkbox') echo 'selected'; ?>>Multi select</option>
            </select>
        </div>
    </div> 

    <div class="form-group ">
        <label for="question" class="control-label col-sm-4">Question</label>
        <div class="col-sm-8">
            <textarea class="form-control" name="question"  >{{$question->question}}</textarea>
        </div>
    </div>

    <div class="list-answer">
        <div class="btn btn-info add-answer-btn">Add answer</div>
        <ul class="list-unstyled">
            @foreach($answers as $answer)
            <li>
                <div class="row form-inline">

                    <input type={{$type}} class="form-control col-sm-2" name="right-answer" {{($answer->is_right_answer==true)?'checked="checked"':''}} >

                    <input type="text" name="answer" class="form-control col-sm-10" style="width:80%" value="{{ $answer->answer }}">

                    <div class="btn btn-danger delete-answer-btn">delete</div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>

</form>
<script>
    $(document).ready(function(){


            $(".add-answer-btn").click(function(){

                var checkType;
                if($("select[name='question_type_id']").val()==1) checkType = '<input type="radio" class="form-control col-sm-2" name="right-answer">';
                else checkType = '<input type="checkbox" class="form-control col-sm-2" name="right-answer">';

                $(".list-answer ul").append('<li>'
                    +' <div class="row form-inline">'
                    + checkType
                    +'<input type="text" class="form-control col-sm-10" style="width:80%">'

                    +'<div class="btn btn-danger delete-answer-btn">delete</div>'
              + ' </div>'
                  +'</li>');
                  $(".delete-answer-btn").click(function(){
                    $(this).closest("li").remove();
                });
            });

            $(".delete-answer-btn").click(function(){
                $(this).closest("li").remove();
            });

            $("select[name='question_type_id']").on('change', function() {
                var question_type_id = $("select[name='question_type_id']").val();
                if (question_type_id == 1) {
                    select_one();
                }
                if (question_type_id == 2) {
                    multi_select();
                }
            });

            $('.list-answer').delegate("input:radio", 'click', function() {
                if ($(this).attr('checked') != 'checked') {
                    $(this).attr('checked', 'checked');
                    $(".list-answer input:radio").not(this).removeAttr('checked');
                }


            });

            $('.list-answer').delegate("input:checkbox", 'click', function() {
                if ($(this).attr('checked') == 'checked') {
                    $(this).removeAttr('checked');
                }
                else {
                    $(this).attr('checked', 'checked');
                }


            });

            function select_one() {
                $(".list-answer input[type='checkbox']").each(function() {
                    $(this).closest('div').prepend('<input type="radio" class="form-control col-sm-2" name="right-answer">');
                    $(this).remove();

                });
            }
            function multi_select() {
                $(".list-answer input[type='radio']").each(function() {
                    $(this).closest('div').prepend('<input type="checkbox" class="form-control col-sm-2" name="right-answer">');
                    $(this).remove();

                });
            }



        });
     </script>
