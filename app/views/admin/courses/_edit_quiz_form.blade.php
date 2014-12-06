
<form id='quiz-form-modal' class="form-horizontal" role="form"> 
    
     <input name="quiz_id" type="hidden" value="{{$quiz->id}}">
        <div class="form-group ">
            <label for="name" class="control-label col-sm-4">Name</label>
            <div class="col-sm-8">
                <input class="form-control" name="name"  value="{{ $quiz->name }}">
            </div>
        </div> 
        <div class="form-group ">
            <label for="duration_minus" class="control-label col-sm-4">Duration minus</label>
            <div class="col-sm-8">
                <input type="number" class="form-control" name="duration_minus"  value="{{$quiz->duration_minus}}">
            </div>
        </div>
        <div class="form-group ">
            <label for="max_attempts" class="control-label col-sm-4">Max attempts</label>
            <div class="col-sm-8">
                <input type="number" class="form-control" name="max_attempts"  value="{{$quiz->max_attempts}}">
            </div>
        </div>
        <div class="form-group">
            <label for="due_date" class="control-label col-sm-4">Due date</label>
            <div class="col-sm-8">
                <input type="date" class="form-control" name="due_date"  value="{{$quiz->due_date}}">
            </div>
        </div>
    
        <div class="form-group ">
            <label for="hard_deadline" class="control-label col-sm-4">Hard Deadline</label>
            <div class="col-sm-8">
                <input type="date" class="form-control" name="hard_deadline"  value="{{$quiz->hard_deadline}}">
            </div>
        </div>
    
        <div class="form-group">
            <label for="description" class="control-label col-sm-4">Description</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="description"  value="{{$quiz->description}}">
            </div>
        </div>
</form>

