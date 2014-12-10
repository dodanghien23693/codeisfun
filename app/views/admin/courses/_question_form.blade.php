
<div class="tabs-vertical-env">

    <ul class="nav tabs-vertical">
        <li> <h2>Quizzes</h2></li><!-- available classes "right-aligned" -->
        @foreach($quizzes as $quiz)
        <li ><a href="#quiz<?php echo $quiz->id; ?>" data-toggle="tab">{{$quiz->name}}</a></li>
        @endforeach
    </ul>
    <div class="tab-content">
        @foreach($quizzes as $quiz)
        <?php
            $questions = Question::where('quiz_id','=',$quiz->id)->get();
        ?>
        <div class="tab-pane" id="quiz<?php echo $quiz->id; ?>" quiz-id="<?php echo $quiz->id; ?>">   
            <div  class="btn btn-info create-question-btn" >Create new question</div>
            <div  class="nested-list dd with-margins custom-drag-button list-question"><!-- adding class "with-margins" will separate list items -->			
                <ul class="dd-list list">       
                    @foreach($questions as $question)
                    <li class="dd-item list-group-item" data-id="{{ $question->id }}" >  

                        <div class="dd-handle">    
                            <span>.</span>     
                            <span>.</span>  
                            <span>.</span>  
                        </div>
                        <div class="dd-content">

                            <div class="col-sm-9 question-name">
                                {{ $question->question }}
                            </div>
                            <div class="btn btn-info edit-question-btn" >Edit</div>
                            <div class="btn btn-danger delete-question-btn" >Delete</div>       
                        </div>
                    </li>  
                    @endforeach

                </ul>
                
                <div  class="btn btn-info update-order-question">Update order of question</div>
                
            </div>
        </div>
        
        @endforeach
    </div>

</div>


<script>
    
    $(document).ready(function(){
        $(".list-question").nestable({
             maxDepth : 1,
        });
        
        
        function registerEventQuestion(){
            
            $(".delete-question-btn").click(function(){
            if(window.confirm("Bạn có chắc chắn muốn xóa question này không?")==true){
                var quiz_id = $(this).closest(".tab-pane").attr('quiz-id');
                var question_id = $(this).closest('.dd-item').attr('data-id');
                $.post('<?php echo url('admin/question/delete')?>',{quiz_id:quiz_id,question_id:question_id},function(response,status){
                    if(status=='success'){
                       if(response.status=='success'){
                           $('.dd-item[data-id='+question_id+']').remove();
                           toastr.success(response.message);
                       }
                       if(response.status=='invalid'){
                           toastr.error(response.message);
                       }
                    }
                    if(status=='error'){
                        
                    }
                });
            }
           });
           
           $(".edit-question-btn").click(function(){
            
                var quiz_id = $(this).closest(".tab-pane").attr('quiz-id');
                var question_id = $(this).closest('.dd-item').attr('data-id');
                $.get('<?php echo url('admin/question/get-edit-form') ?>',{action:"update",quiz_id:quiz_id,question_id : question_id},function(response,status){
                    if(status=='success'){
                        if(response.status=='success'){
                            $("#question-modal .modal-body").html(response.html);
                            $("#question-modal").modal('show');
                            $("#question-form-modal input[name='question_id']").val(question_id);
                            $("#question-form-modal input[name='quiz_id']").val(quiz_id);
                            $("#question-modal .modal-footer button").addClass('update-question-modal-btn');
                            $("#question-modal .modal-footer button").removeClass('create-question-modal-btn');
                        }
                        if(response.status=='invalid'){
                            toastr.error(response.message);
                        }  
                    }
                });
                

             });
        }
  
        registerEventQuestion();
        
        
        $('#question-modal').delegate('.update-question-modal-btn','click',function(){
           var question_id =  $("#question-form-modal input[name='question_id']").val();
           var quiz_id =  $("#question-form-modal input[name='quiz_id']").val();
           var question= $("#question-form-modal textarea[name='question']").val();
           var question_type_id = $("#question-form-modal select[name='question_type_id']").val();
           var list_answer = {};
           
           $("#question-form-modal .list-answer .form-inline").each(function(index){
               list_answer[index] = { answer : $(this).find("input:text").val() , checked : $(this).find("input:radio, input:checkbox").attr("checked")?'checked':'' };
                
            });
            
            list_answer = JSON.stringify(list_answer);
           
           
           $.post('<?php echo url("admin/question/edit");?>',{action: "update" ,question_id : question_id, quiz_id : quiz_id, question:question , question_type_id: question_type_id, list_answer : list_answer},function(response,status){
               if(status=='success'){
                   
                   $(".list-question .dd-item[data-id='"+question_id+"'] .question-name").html(question);
                   $("#question-modal").modal('hide');
                  
                  //alert(response);
               }
               if(status=='error'){
                   
               }
           });
        });
        
        
      
      
        
        $("#question-modal").delegate("#question-form-modal textarea",'change',function (e) {
            $("#question-form-modal").validate().element($(e.target));
        });

        $("#question-modal").delegate('.create-question-modal-btn','click',function(){
            
           
           var quiz_id =  $("#question-form-modal input[name='quiz_id']").val();
           var question_list = $(".tab-pane[quiz-id='"+quiz_id+"'] .list-question ul");
           var question= $("#question-form-modal textarea[name='question']").val();
           var question_type_id = $("#question-form-modal select[name='question_type_id']").val();
           var list_answer = {};
           
          $("#question-form-modal .list-answer .form-inline").each(function(index){
               list_answer[index] = { answer : $(this).find("input:text").val() , checked : $(this).find("input:radio, input:checkbox").attr("checked")?'checked':'' };
                
            });
            
            list_answer = JSON.stringify(list_answer);
           
         
           $.post('<?php echo url("admin/question/edit");?>',{action: "create" , quiz_id : quiz_id, question:question , question_type_id: question_type_id, list_answer : list_answer},function(response,status){
               if(status=='success'){
                   
                   
                   var newItem = '<li class="dd-item list-group-item" data-id="'+response.question_id+'" >'  
                    
                    +'<div class="dd-handle">  '  
                        + '<span>.</span> '    
                        +'<span>.</span> ' 
                        +'<span>.</span> '      
                    +'</div>'
                    +'<div class="dd-content">'
                    +'<div class="col-sm-9 question-name">'
                        + question
                    +'</div>'
                    +'<div class="btn btn-info edit-question-btn" >Edit</div>'
                    +'<div class="btn btn-danger delete-question-btn" >Delete</div>  '  
                    +'</div>'
                +'</li>';

                   $(question_list).append(newItem);
                   registerEventQuestion();
                   $("#question-modal").modal('hide');
                }
               if(status=='error'){
                   
               }
           });
        });
        
        
        
        $(".create-question-btn").click(function(){
           var quiz_id = $(this).closest(".tab-pane").attr('quiz-id'); 
           $.get('<?php echo url('admin/question/get-edit-form') ?>',{action:"create",quiz_id:quiz_id},function(response,status){
               if(status=='success'){
                   if(response.status=='success'){
                        $("#question-modal .modal-body").html(response.html);
                        $("#question-modal").modal('show');
                        $("#question-modal .modal-footer button").addClass('create-question-modal-btn');
                        $("#question-modal .modal-footer button").removeClass('update-question-modal-btn');
                   }
                   if(response.status=='invalid'){
                       toastr.error(response.message);
                   }
                   
               }
           });
           
           
           
           
           //$("#create-question-form-modal input[name='quiz_id']").val(quiz_id);

        });
        
       

       
       $('.update-order-question').click(function(){
       
        var order = window.JSON.stringify($(this).closest('.list-question').nestable('serialize'));
        var quiz_id = $(this).closest('.tab-pane').attr('quiz-id');
        
        $.post('<?php echo url('admin/question/update-order-question') ?>',{order_question: order,quiz_id : quiz_id },function(response,status){
            if(status=='success'){
               if(response.status=='success')
               {
                   toastr.success(response.message);
               }
               if(response.status=='invalid')
               {
                   toastr.error(response.message);
               }
            }
            if(status=='error'){
                alert('cập nhật thất bại');
            }
            
        });
        
     });
        
        
    });
    
    
   
</script>



