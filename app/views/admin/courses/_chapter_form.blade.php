<!-- recieve variable $chapters form server 

-->


    
<form id='create-chapter-form' class="form-inline" method="POST" action=''>
    <label class="col-sm-3">New chapter</label>
    <input id="chapter-name" name='chapter-name' type='text' class="col-sm-4" placeholder="name" class="form-control" />
    <div  class="btn btn-info create-chapter-btn" >Create new chapter</div>
</form>

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
                        <div class="col-sm-10">
                            {{$chapter->name}}
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
    
    
    function showEditChapterModal(chapter_id)
    {
            $('#edit-chapter-modal').modal('show', {backdrop : 'static'});

             $('#edit-chapter-modal .modal-body').html('Is loading.......');
            $.get('<?php echo url('admin/chapter/get-edit-chapter-form'); ?>',{chapter_id : chapter_id},function(response,status){
                if(status=='success'){
                   
                    $('#edit-chapter-modal .modal-body').html(response);
                }
            });
            

    }
    
    $('.edit-chapter-btn').click(function(){
        var chapter_id = $(this).closest(".dd-item").attr('data-id');
        showEditChapterModal(chapter_id);
    });
    
    $('#update-order-chapter').click(function(){
        var order = window.JSON.stringify($('.list-chapter').nestable('serialize'));
        alert(order);
        $.post('<?php echo url('admin/course/update-order-chapter') ?>',{order_chapter: order,course_id : <?php echo $course->id; ?> },function(response,status){
            if(status=='success'){
               
                alert(response);
            }
            if(status=='error'){
                alert('cập nhật thất bại');
            }
            
        });
        
     });

     function registerEventChapter(){
        $(".delete-chapter-btn").click(function(){
        if(window.confirm("Bạn có chắc chắn muốn xóa chapter này không?")==true){
            var chapter_id = $(this).closest('.dd-item').attr('data-id');
            $.post('<?php echo url('admin/chapter/delete')?>',{chapter_id:chapter_id},function(response,status){
                if(status=='success'){
                    $('.dd-item[data-id='+chapter_id+']').remove();
                    
                    $('#lecture-form[chapter-id="'+chapter_id+'"]').remove();
                    alert('Xoa thanh cong!');
                }
                if(status=='error'){
                    alert('xoa that bai');
                }
            });
        }
        });
     }
     
     registerEventChapter();
     
     
    $(".create-chapter-btn").click(function(){
     
     
     var chapter_name = $("#create-chapter-form #chapter-name").val();
     var course_id = <?php echo $course->id; ?>;
     var chapter_list = $(".list-chapter");
     
     
     
     $.post('<?php echo url('admin/chapter/new'); ?>',{'chapter-name' : chapter_name,'course_id':course_id},function(response,status){
            if(status=='success'){       

            var newItem = '<li class="dd-item" data-id="'+response.chapter_id+'" >'
                   + '<div class="dd-handle">'
                    +    '<span>.</span>'
                    +   ' <span>.</span>'
                   +     '<span>.</span>'
                  + '</div>' 
                   +'<div class="dd-content">'
                       + '<div class="row">'
                        +'<div class="col-sm-10">'
                            + chapter_name
                       +' </div>'
                       +'<div class="btn btn-info edit-chapter-btn" >Edit</div>'
                       +' <div class="btn btn-danger delete-chapter-btn" >Delete</div>'
                        + '</div>'
                    +'</div>'
              + '</li>';
      
              $(chapter_list).append(newItem);
             registerEventChapter();
           
          $("#lecture-tab-content").html(response.html);
            alert(response.message);

            }    
            if(status=='error'){
                alert('Không thành công');
            }
        });

    });    
    
    

    
    
 });
 
</script>
@section('scripts')
<div class="modal fade" id="edit-chapter-modal" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Dynamic Content</h4>
			</div>
			
			<div class="modal-body">
			
                            <form class="form-horizontal" role='form'>
                                <label class="control-label" >Name</label>
                            </form>
                              
				
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button id="update-chapter-btn" type="button" class="btn btn-info">Save changes</button>
			</div>
		</div>
	</div>
</div>
@stop