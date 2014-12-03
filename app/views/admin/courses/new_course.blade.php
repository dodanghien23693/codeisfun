@extends('admin.layouts.default')

@section('content')

<form role='form' action="<?php echo url('admin/course/new'); ?>" method="post" class="form-horizontal">
    <?php echo Form::token(); ?>
    <div class="form-group">
        <label for="name" class="control-label col-sm-4">Name</label>
        <div class="col-sm-8">
            <input data-validate="required" id="name" name="name"  class="form-control" type="text">
        </div>        
    </div>
    
    <div class="form-group">
        <label for="short_name" class="control-label col-sm-4">Short name</label>
        <div class="col-sm-8">
            <input id="short_name" name="short_name"  class="form-control" type="text">
        </div>        
    </div>
    
    <div class="form-group">
        <label for="start_day" class="control-label col-sm-4">Start day</label>
        <div class="col-sm-8">
            <input id="start_day" type="date" name="start_day"  class="form-control" >
        </div>        
    </div>
    
    <div class="form-group">
        <label for="end_day" class="control-label col-sm-4">End day</label>
        <div class="col-sm-8">
            <input  id="end_day" name="end_day"  class="form-control" type="date">
        </div>        
    </div>
    <input type="submit" class="form-control" value="Create new">
</form>
@stop

