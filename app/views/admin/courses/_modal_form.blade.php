
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
	<div class="modal-dialog">
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
<div class="modal fade modal-lg" id="edit-lecture-modal" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Edit lecture</h4>
			</div>
			
			<div class="modal-body">
			  show ajax form
			</div>
			
			<div class="modal-footer">	
				<button  type="button" class="btn btn-info">Save changes</button>
			</div>
		</div>
	</div>
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

