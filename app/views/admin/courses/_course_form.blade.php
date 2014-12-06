

<div id="course_form" class="form-horizontal">
    <input type="hidden" id="id" value='{{$course->id }}'>
    <div class="form-group">
        <label for="name" class="control-label col-sm-4">Name</label>
        <div class="col-sm-8">
            <input data-validate="required" id="name" name="name" value='{{$course->name}}' class="form-control" type="text">
        </div>        
    </div>
    
    <div class="form-group">
        <label for="short_name" class="control-label col-sm-4">Short name</label>
        <div class="col-sm-8">
            <input id="short_name" name="short_name" value='{{$course->short_name}}' class="form-control" type="text">
        </div>        
    </div>
    
    <div class="form-group">
        <label for="start_day" class="control-label col-sm-4">Start day</label>
        <div class="col-sm-8">
            <input id="start_day" type="date" name="start_day" value='{{$course->start_day}}' class="form-control" >
        </div>        
    </div>
    
    <div class="form-group">
        <label for="end_day" class="control-label col-sm-4">End day</label>
        <div class="col-sm-8">
            <input  id="end_day" name="end_day" value='{{$course->end_day}}' class="form-control" type="date">
        </div>        
    </div>

   
    <div  id='update-course'  class="btn btn-info col-sm-offset-4">Update</div>
    <div  id='delete-course'  class="btn btn-info ">Delete</div>
   
</div>


<script>
    $("#course_form #delete-course").click(function(){
        if(confirm("Bạn có chắc chắn muốn xóa không?")==true){
            var course_id = $("#course_form #id").val();
            $.get('<?php echo url('admin/course/delete') ?>',{'id' : course_id},function(response,status){
                if(status=='success'){
                    window.location.replace('<?php echo url('admin/course'); ?>')
                }
                if(status=='error'){
                    alert('That bai');
                }
            });
        }
        
    });
    
    $('#course_form #update-course').click(function(){
      
       var id = $('#course_form #id').val();
       var name = $('#course_form #name').val();
       var short_name = $('#course_form #short_name').val();
       var start_day = $('#course_form #start_day').val();
       var end_day = $('#course_form #end_day').val();
       
       $.post('<?php echo url('admin/course/edit/'.$course->id); ?>',{
        'course-id':id,
       'course-name' : name, 
       'course-short_name' : short_name,
        'course-start_day' : start_day,
        'course-end_day' : end_day },
        function(response,status){
           if(status=='success'){
              alert('thanh cong');
           }
           if(status=='error'){
               alert('Không thành công');
           }
       });
    });
</script>
