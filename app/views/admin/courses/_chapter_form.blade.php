<!-- recieve variable $chapters form server 

-->


    

<div  class="btn btn-info create-chapter-btn" >Create new chapter</div>
    


<div id='chapter_form' class="panel panel-primary" data-collapsed="0">

    <div class="panel-heading">
        <div class="panel-title">
            Edit Order of Chapter
        </div>

        <div class="panel-options">
            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
        </div>
    </div>

    <div class="panel-body">
        <div  class="nested-list dd with-margins custom-drag-button list-chapter"><!-- adding class "with-margins" will separate list items -->			
            <ul class="dd-list">      
                @foreach($chapters as $chapter)
                
                <li class="dd-item" data-id="{{ $chapter->id }}" >
                   
                    <div class="dd-handle">
                        <span>.</span>
                        <span>.</span>
                        <span>.</span>
                    </div>
                    
                    <div class="dd-content">
                        <div class="row">
                        <div class="col-sm-5 chapter-name">
                            {{$chapter->name}}
                        </div>
                        <div class="col-sm-5">
                            created by: {{User::where('id','=',$chapter->user_id)->first()->username}}
                        </div>    
                           
                        <div class=" btn btn-info edit-chapter-btn" >Edit</div>
                        <div class=" btn btn-danger delete-chapter-btn" >Delete</div>
                         </div>
                    </div>
                   
                </li>

                @endforeach
                
            </ul>
           

        </div>
         <div id="update-order-chapter" class="btn btn-info">Update order of chapter</div>
    </div>
    
</div>


<script>   
 $(document).ready(function(){
 

     
    $(".list-chapter").nestable({
        maxDepth : 1,
    });
    
    
    $('#update-order-chapter').click(function(){
        var order = window.JSON.stringify($('.list-chapter').nestable('serialize'));
       
        $.post('<?php echo url('admin/course/update-order-chapter') ?>',{order_chapter: order,course_id : <?php echo $course->id; ?> },function(response,status){
            if(status=='success'){
               if(response.status=='success'){
                   $("#lecture-tab-content").html(response.html);
                   toastr.success(response.message);
               }
               if(response.status=='invalid'){
                   toastr.error(response.message);
               }
                
            }
        
        });
        
     });

     function registerEventChapter(){
        $(".delete-chapter-btn").click(function(){
        if(window.confirm("Bạn có chắc chắn muốn xóa chapter này không?")==true){
            var chapter_id = $(this).closest('.dd-item').attr('data-id');
            $.post('<?php echo url('admin/chapter/delete')?>',{chapter_id:chapter_id},function(response,status){
                if(status=='success'){
                    if(response.status=='success'){
                        $('.dd-item[data-id='+chapter_id+']').remove();
                        $('a[href="#chapter'+chapter_id+'"]').closest('li').remove();
                        toastr.success(response.message);
                    }
                    else if(response.status=='invalid'){
                        toastr.error(response.message);
                    }
                  
                }
                if(status=='error'){
                    alert('xoa that bai');
                }
            });
        }
        });
        
        $('.edit-chapter-btn').click(function(event){
            event.preventDefault();
            var chapter_id = $(this).closest(".dd-item").attr('data-id');
            showEditChapterModal(chapter_id);
        });
     }
     
     function showEditChapterModal(chapter_id)
    {
            $.get('<?php echo url('admin/chapter/get-edit-chapter-form'); ?>',{chapter_id : chapter_id},function(response,status){
                if(status=='success'){
                    if(response.status=='success')
                    {
                        $('#edit-chapter-modal .modal-body').html(response.html);
                        $('#edit-chapter-modal').modal('show');
                    }
                    else
                    {
                        toastr.error(response.message);
                    }
                    
                }
            });
            
            
            

    }
     registerEventChapter();
     
     
     $(".create-chapter-btn").on('click',function(e){
        
  
        $("#create-chapter-modal").modal('show');

     });
     
   
    $('#update-chapter-btn-modal').click(function(){
        var id =  $(".edit-chapter-form-modal input[name='id']").val();
        var name =  $(".edit-chapter-form-modal input[name='name']").val();
        $.post('<?php echo url('admin/chapter/edit') ?>',{id:id, name:name},function(response,status){
           if(status=='success'){
               if(response.status=='success'){
                    $(".list-chapter .dd-item[data-id='"+id+"'] .chapter-name").html(name);
                    $(".tab-pane a[href='#chapter"+id+"']").html(name);
                    $("#edit-chapter-modal").modal('hide');
                    toastr.success(response.message);
               }
              
           } 
           if(status=='error'){
               alert('that bai');
           }
        });
    });

    
     $("#create-chapter-modal-btn").click(function(){
        
        var name = $("#create-chapter-form-modal input[name='name']").val();
        var course_id = <?php echo $course->id; ?>;
        var chapter_list = $(".list-chapter ul");
         $.post('<?php echo url('admin/chapter/new'); ?>',{name : name, course_id : course_id},function(response,status){
            if(status=='success'){       
            if(response.status=='success')
            {
                toastr.success(response.message);
                var newItem = '<li class="dd-item" data-id="'+response.chapter_id+'" >'
                       + '<div class="dd-handle">'
                        +    '<span>.</span>'
                        +   ' <span>.</span>'
                       +     '<span>.</span>'
                      + '</div>' 
                       +'<div class="dd-content">'
                           + '<div class="row">'
                            +'<div class="col-sm-5 chapter-name">'
                                + name
                           +' </div>'
                          +'<div class="col-sm-5">'
                                +'created by: <?php echo Auth::user()->username ?>'
                           +' </div> '  
                           +'<div class="btn btn-info edit-chapter-btn" >Edit</div>'
                           +' <div class="btn btn-danger delete-chapter-btn" >Delete</div>'
                            + '</div>'
                        +'</div>'
                  + '</li>';

                    $(chapter_list).append(newItem);
                    registerEventChapter();
                    $("#lecture-tab-content").html(response.html);
                    $("#create-chapter-modal").modal('hide');

                    }
                }
        if(status=='error'){
            alert('Không thành công');
        }
            });
         });
         
 });
 
</script>
