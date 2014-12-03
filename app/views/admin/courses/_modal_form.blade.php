
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
                                       <input type="hidden" value="" name="chapter_id" class="form-control">
                                       <div class="form-group form-horizontal">
                                           <label for="name" class="control-label col-sm-4">Name</label>
                                           <div class="col-sm-8">
                                               <input class="form-control" name="name" id="name" >
                                           </div>
                                       </div>    
                           </form>
                            toi la hien
				
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button id="create-lecture-modal-btn" type="button" class="btn btn-info">Save changes</button>
			</div>
		</div>
	</div>
</div>
