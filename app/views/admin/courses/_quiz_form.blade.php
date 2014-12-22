<!-- recieve variable $quizzes form server 

-->
 
<div  class="btn btn-info create-quiz-btn" >Create new quiz</div>

<div id='quiz_form' class="panel panel-primary" data-collapsed="0">

    <div class="panel-heading">
        <div class="panel-title">
            Edit Order of Chapter
        </div>

        <div class="panel-options">
            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
        </div>
    </div>

    <div class="panel-body">
        <div id="list-quiz"  class="nested-list dd with-margins custom-drag-button"><!-- adding class "with-margins" will separate list items -->			
            <ul class="dd-list">      
                @foreach($quizzes as $quiz)
                
                <li class="dd-item" data-id="{{ $quiz->id }}" >
                   
                    <div class="dd-handle">
                        <span>.</span>
                        <span>.</span>
                        <span>.</span>
                    </div>
                    
                    <div class="dd-content">
                        <div class="row">
                        <div class="col-sm-5 quiz-name">
                            {{$quiz->name}}
                        </div>
                        <div class="col-sm-5 quiz-name">
                            created by: {{User::find($quiz->user_id)->username}}
                        </div>
                        <div class=" btn btn-info edit-quiz-btn" >Edit</div>
                        <div class=" btn btn-danger delete-quiz-btn" >Delete</div>
                         </div>
                    </div>
                   
                </li>

                @endforeach
                
            </ul>
           

        </div>
    </div>
    
</div>


<script>   
 $(document).ready(function(){
     
     
    $(".list-quiz").nestable({
        maxDepth : 1,
    });
    
    

     function registerEventQuiz(){
        $(".delete-quiz-btn").click(function(){
            if(window.confirm("Bạn có chắc chắn muốn xóa quiz này không?")==true){
                var quiz_id = $(this).closest('.dd-item').attr('data-id');
                $.post('<?php echo url('admin/quiz/delete')?>',{quiz_id:quiz_id},function(response,status){
                    if(status=='success'){
                        if(response.status=='success'){
                            $('.dd-item[data-id='+quiz_id+']').remove();
                            $('a[href="#quiz'+quiz_id+'"]').closest('li').remove();
                            toastr.success(response.message);
                        }
                        if(response.status=='invalid'){
                            toastr.error(response.message);
                        }   
                    }
                    if(status=='error'){
                        alert('xoa that bai');
                    }
                });
            }
        });
        
        $('.edit-quiz-btn').click(function(){
            var quiz_id = $(this).closest(".dd-item").attr('data-id');
            var course_id = <?php echo $course->id ?>;
            $.get('<?php echo url('admin/quiz/get-edit-form'); ?>',{action:"update",quiz_id : quiz_id,course_id:course_id},function(response,status){
                if(status=='success'){
                    if(response.status=='success'){
                        $('#edit-quiz-modal .modal-body').html(response.html);
                        $('#edit-quiz-modal').modal('show');
                        $("#edit-quiz-modal .modal-footer button").addClass('update-quiz-modal-btn');
                        $("#edit-quiz-modal .modal-footer button").removeClass('create-quiz-modal-btn');
                    }
                    if(response.status=='invalid'){
                        toastr.error(response.message);
                    }
                    
                }
            });
 
        });
     }
     
     registerEventQuiz();
     
     
     
     $("#edit-quiz-modal").delegate(".create-quiz-modal-btn",'click',function(){
     
        
        var quiz_list = $("#list-quiz");
        var course_id = <?php echo $course->id; ?>;
        var name = $("#quiz-form-modal input[name='name']").val();
        var duration_minus = $("#quiz-form-modal input[name='duration_minus']").val();
        var max_attempts = $("#quiz-form-modal input[name='max_attempts']").val();
        var due_date = $("#quiz-form-modal input[name='due_date']").val();
        var hard_deadline = $("#quiz-form-modal input[name='hard_deadline']").val();
        var description = $("#quiz-form-modal input[name='description']").val();
      
     $.post('<?php echo url('admin/quiz/edit'); ?>',{action:"create" ,name : name,course_id:course_id,duration_minus:duration_minus,max_attempts:max_attempts, due_date:due_date, hard_deadline:hard_deadline,description:description},
     function(response,status){
            if(status=='success'){       

            var newItem = '<li class="dd-item" data-id="'+response.quiz_id+'" >'
                   + '<div class="dd-handle">'
                    +    '<span>.</span>'
                    +   ' <span>.</span>'
                   +     '<span>.</span>'
                  + '</div>' 
                   +'<div class="dd-content">'
                       + '<div class="row">'
                        +'<div class="col-sm-5 quiz-name">'
                            + name
                       +' </div>'
                        +'<div class="col-sm-5 quiz-name">'
                            + 'created by: <?php echo Auth::user()->username;?>'
                       +' </div>'
                       +'<div class="btn btn-info edit-quiz-btn" >Edit</div>'
                       +' <div class="btn btn-danger delete-quiz-btn" >Delete</div>'
                        + '</div>'
                    +'</div>'
              + '</li>';
      
             $(quiz_list).append(newItem);
             registerEventQuiz();
             toastr.success(response.message);
             $("#edit-quiz-modal").modal('hide');
             $("#question-tab-content").html(response.html);

            }    
            if(status=='error'){
                alert('Không thành công');
            }
        });
     });
     
     
      $("#edit-quiz-modal").delegate(".update-quiz-modal-btn",'click',function(){

        var id = $("#quiz-form-modal input[name='quiz_id']").val();
        var name = $("#quiz-form-modal input[name='name']").val();
        var duration_minus = $("#quiz-form-modal input[name='duration_minus']").val();
        var max_attempts = $("#quiz-form-modal input[name='max_attempts']").val();
        var due_date = $("#quiz-form-modal input[name='due_date']").val();
        var hard_deadline = $("#quiz-form-modal input[name='hard_deadline']").val();
        var description = $("#quiz-form-modal input[name='description']").val();
     $.post('<?php echo url('admin/quiz/edit'); ?>',{action:"update" ,name : name,id:id,duration_minus:duration_minus,max_attempts:max_attempts, due_date:due_date, hard_deadline:hard_deadline,description:description},
    function(response,status){
            if(status=='success'){ 
                if(response.status=='success'){ 
                    $("#list-quiz .dd-item[data-id='"+id+"'] .quiz-name").html(name);
                    $(".tab-pane a[href='#quiz"+id+"']").html(name);
                    registerEventQuiz();
                    toastr.success(response.message);
                    $("#edit-quiz-modal").modal('hide');
                }
                if(response.status=='invalid'){
                    toastr.error(response.message);
                }
            }    
            if(status=='error'){
                alert('Không thành công');
            }
        });
     });
     

    $(".create-quiz-btn").click(function(){
     
       var course_id = <?php echo $course->id; ?>;
       $.get('<?php echo url('admin/quiz/get-edit-form'); ?>',{action:"create",course_id:course_id},function(response,status){
                   if(status=='success'){
                       if(response.status=='success'){
                           $('#edit-quiz-modal .modal-body').html(response.html);
                           $("#edit-quiz-modal").modal('show');
                            $("#edit-quiz-modal .modal-footer button").addClass('create-quiz-modal-btn');
                            $("#edit-quiz-modal .modal-footer button").removeClass('update-quiz-modal-btn');
                       }
                       if(response.status=='invalid'){
                           toastr.error(response.message);
                       }
                   }
       });
       
       
      
    });    
    
 });
 
</script>
