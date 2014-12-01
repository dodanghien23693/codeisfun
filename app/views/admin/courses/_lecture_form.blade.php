





@foreach($chapters as $chapter)

<?php 

$lectures = Lecture::where('chapter_id','=',$chapter->id)->orderBy('order_of_lecture')->get();

?>

<div id='lecture-form' class="panel panel-primary panel-collapse" data-collapsed="1" chapter-id="{{$chapter->id}}">

    <div class="panel-heading">
        <div class="panel-title">
            {{$chapter->name}}
        </div>

        <div class="panel-options">
            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
        </div>
    </div>

    <div class="panel-body">

        <form id='create-lecture-form' class="form-inline" method="POST" action=''>
            <label class="col-sm-1 control-label" for="lecture-name">New lecture</label>
            
            <input id="lecture-name" name='lecture-name' type='text' class="col-sm-5 form-control" placeholder="name" />
            <div  class="btn btn-info create-lecture-btn form-control" >Create new chapter</div>
        </form>

        
        <div  class="nested-list dd with-margins custom-drag-button list-lecture"><!-- adding class "with-margins" will separate list items -->			
            <ul class="dd-list list">       
                @foreach($lectures as $lecture)
                
                <li class="dd-item list-group-item" data-id="{{ $lecture->id }}" >  
                    
                    <div class="dd-handle">    
                        <span>.</span>     
                        <span>.</span>  
                        <span>.</span>  
                    </div>
                    <div class="dd-content">
                        
                        <div class="col-sm-9">
                            {{ $lecture->name }}
                        </div>
                        <div class="btn btn-info" >Edit</div>
                        <div class="btn btn-danger delete-lecture-btn" >Delete</div>       
                    </div>
                </li>  
                    
                
                @endforeach

            </ul>
            <div  class="btn btn-info update-order-lecture">Update order of chapter</div>

        </div>
    </div>

</div>

@endforeach



<div class="modal fade" id="create-lecture-modal" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Create new Lecture</h4>
			</div>
			
			<div class="modal-body">
			
                            
				
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button id="create-lecture-modal-btn" type="button" class="btn btn-info">Save changes</button>
			</div>
		</div>
	</div>
</div>

<script>
    
    $(document).ready(function(){
        $(".list-lecture").nestable({
             maxDepth : 1,
        });
        
        
        function registerEventLecture(){
            
            $(".delete-lecture-btn").click(function(){
            if(window.confirm("Bạn có chắc chắn muốn xóa lecture này không?")==true){
                var lecture_id = $(this).closest('.dd-item').attr('data-id');
                $.post('<?php echo url('admin/lecture/delete')?>',{lecture_id:lecture_id},function(response,status){
                    if(status=='success'){
                        alert('Xoa thanh cong!');
                        $('.dd-item[data-id='+lecture_id+']').remove();
                    }
                    if(status=='error'){
                        alert('xoa that bai');
                    }
                });
            }
           });
        }
        registerEventLecture();
        $(".create-lecture-btn").click(function(){
            alert('mo form de tao');
            $("#create-lecture-modal").modal('show', {backdrop : 'static'});
            
            /*
           var lecture_list = $(this).closest(".panel-body").find(".list-lecture ul");
           var chapter_id =  $(this).closest("#lecture-form").attr('chapter-id');
           var lecture_name = $(this).closest("#create-lecture-form").find("input[name='lecture-name']").val();
           alert('chuan bi tao lecture moi');
           $.post('<?php echo url("admin/lecture/new");?>',{chapter_id:chapter_id, lecture_name:lecture_name},function(response,status){
               if(status=='success'){
                   
                   
                   var newItem = '<li class="dd-item list-group-item" data-id="'+response.lecture_id+'" >'  
                    
                    +'<div class="dd-handle">  '  
                        + '<span>.</span> '    
                        +'<span>.</span> ' 
                        +'<span>.</span> '      
                    +'</div>'
                    +'<div class="dd-content">'
                    +'<div class="col-sm-9">'
                        +lecture_name
                    +'</div>'
                    +'<div class="btn btn-info" >Edit</div>'
                    +'<div class="btn btn-danger delete-lecture-btn" >Delete</div>  '  
                    +'</div>'
                +'</li>';

                   $(lecture_list).append(newItem);
                   registerEventLecture();
                   alert('thanh cong');
               }
               if(status=='error'){
                   
               }
           });
           
           */
           
        });
        
     
       
       $('.update-order-lecture').click(function(){
       
        var order = window.JSON.stringify($(this).closest('.list-lecture').nestable('serialize'));
        var chapter_id = $(this).closest('#lecture-form').attr('chapter-id');
        alert(order);
        $.post('<?php echo url('admin/chapter/update-order-lecture') ?>',{order_lecture: order,chapter_id : chapter_id },function(response,status){
            if(status=='success'){
               
                alert(response);
            }
            if(status=='error'){
                alert('cập nhật thất bại');
            }
            
        });
        
     });
        
        
    });
</script>

