
<!-- edit chapter modal -->
<div class="modal fade" id="edit-chapter-modal" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Edit chapter</h4>
			</div>
			
			<div class="modal-body">
			  show ajax form
			</div>
			
			<div class="modal-footer">	
				<button id="update-chapter-btn-modal" type="button" class="btn btn-info">Update</button>
			</div>
		</div>
	</div>
</div>

<!--create chapter modal -->
 <div class="modal fade" id="create-chapter-modal" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Create new chapter</h4>
			</div>
			<div class="modal-body">
			
                            <form id='create-chapter-form-modal' class="form-horizontal" role="form">
                                       <input type="hidden" value="{{$course->id}}" name="course_id" class="form-control">
                                       <div class="form-group form-horizontal">
                                           <label for="name" class="control-label col-sm-4">Name</label>
                                           <div class="col-sm-8">
                                               <input class="form-control" name="name" id="name" >
                                           </div>
                                       </div>  
                               
                                
                           </form>	
			</div>
                        <div class="modal-footer">
				
				<div id ="create-chapter-modal-btn" class="btn btn-info " >Create</div>
			</div>
		</div>
	</div>

</div>



<!--create lecture form -->
 <div class="modal fade" id="create-lecture-modal" aria-hidden="true" style="display: none;">
     <div class="modal-dialog" style="width: 800px">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Create new Lecture</h4>
			</div>
			
			<div class="modal-body">
			
                           <form id='create-lecture-form-modal' class="form-horizontal" role="form">
                               <input type="hidden" name="chapter_id">
                                <div class="form-group form-horizontal">
                                    <label for="name" class="control-label col-sm-4">Name</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="name" id="name" >
                                    </div>
                                </div> 
                            </form>

				
			</div>
			
			<div class="modal-footer">
				
				<button id="create-lecture-modal-btn" type="button" class="btn btn-info">Save changes</button>
			</div>
		</div>
	</div>

</div>

<!-- edit lecture modal -->
<div class="modal fade" id="edit-lecture-modal" aria-hidden="true" style="display: none">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Edit lecture</h4>
			</div>
			
			<div class="modal-body">
                            <input name="chapter_id" type="hidden">
                            <input name="id" type="hidden">
                            <div class="row">
                                <div class="col-sm-8">
                                    <input type="text" name='name' placeholder="lecture name" class="form-control">
                                </div>
                                <div class="col-sm-2 btn btn-info create-lecture-with-name" id="save-lecture">Next</div>
                            </div>
                            <div id="iframe-lecture" style="display:none">
                              
                            </div>
			</div>
			
			<div class="modal-footer">	
				<button  type="button" class="btn btn-info">Save changes</button>
			</div>
		</div>
	</div>
    
    <script>
        $(document).ready(function(){
            $("#edit-lecture-modal").delegate(".create-lecture-with-name",'click',function(){
                var chapter_id = $("#edit-lecture-modal input[name='chapter_id']").val();
                var name = $("#edit-lecture-modal input[name='name']").val();
                var lecture_list = $("#chapter"+chapter_id+" .list-lecture ul");
                $.post('<?php echo url("admin/lecture/edit"); ?>', {action: "create", chapter_id: chapter_id, name: name}, function(response, status) {
                if (status == 'success') {
                        if(response.status == 'success'){
                            
                            toastr.success(response.message);
                            
                            var newItem = '<li class="dd-item list-group-item" data-id="' + response.lecture_id + '" >'

                                    + '<div class="dd-handle">  '
                                    + '<span>.</span> '
                                    + '<span>.</span> '
                                    + '<span>.</span> '
                                    + '</div>'
                                    + '<div class="dd-content">'
                                    + '<div class="col-sm-9 lecture-name">'
                                    + name
                                    + '</div>'
                                    + '<div class="btn btn-info edit-lecture-btn" >Edit</div>'
                                    + '<div class="btn btn-danger delete-lecture-btn" >Delete</div>  '
                                    + '</div>'
                                    + '</li>';

                            $(lecture_list).append(newItem);
                          //  registerEventLecture();
                            //$("#edit-lecture-modal").modal('hide');

                            $(".create-lecture-with-name").hide(500);
                            $("#edit-lecture-modal #iframe-lecture").append('<iframe  src="<?php echo url('admin/lecture/get-edit-form');?>'+'?lecture_id='+response.lecture_id+'" style="width:100%; height:400px"></iframe>');
                            $("#edit-lecture-modal #iframe-lecture").show(500);
                        }
                    }
                    
                    if(response.status == 'invalid')
                    {
                        toastr.error(response.message);
                    }
                    
                    if (status == 'error') {

                    }
                });
            });

             $("#edit-lecture-modal").delegate(".update-lecture-with-name",'click',function(){
                var chapter_id = $("#edit-lecture-modal input[name='chapter_id']").val();
                var name = $("#edit-lecture-modal input[name='name']").val();
                var id = $("#edit-lecture-modal input[name='id']").val();
                $.post('<?php echo url("admin/lecture/edit"); ?>', {action: "update", name: name, id:id,chapter_id:chapter_id}, function(response, status) {
                if (status == 'success') {
                       if(response.status=='success'){
                            $(".list-lecture .dd-item[data-id='" + id + "'] .lecture-name").html(name);
                            $(".update-lecture-with-name").hide(500);
                            $("#edit-lecture-modal #iframe-lecture").append('<iframe  src="<?php echo url('admin/lecture/get-edit-form');?>'+'?lecture_id='+response.lecture_id+'" style="width:100%; height:400px"></iframe>');
                            $("#edit-lecture-modal #iframe-lecture").show(500);
                       }
                       if(response.status =='invalid'){
                           toastr.error(response.message);
                       }
                    }
                    if (status == 'error') {

                    }
                });
            });
        });
        
    </script>
</div>




<!--edit quiz modal -->

 <div class="modal fade" id="edit-quiz-modal" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Edit Quiz</h4>
			</div>
			
			<div class="modal-body">
			
                              show ajax content
			</div>
			
			<div class="modal-footer">
				<button  type="button" class="btn btn-info">Save changes</button>
			</div>
		</div>
	</div>

</div>


<!--edit question modal -->
 <div class="modal fade" id="question-modal" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Edit Question</h4>
			</div>
			
			<div class="modal-body">
			
                              show ajax content
			</div>
			
			<div class="modal-footer">
				<button  type="button" class="btn btn-info">Save changes</button>
			</div>
		</div>
	</div>

</div>

