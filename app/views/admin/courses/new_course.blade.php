@extends('admin.layouts.default')
@section('content')

<form role='form' action="<?php echo url('admin/course/new'); ?>" method="post" class="form-horizontal">
    <?php echo Form::token(); ?>
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
    
    <div class="form-group">
        <label for="about_the_course" class="control-label col-sm-4">About the course</label>
        <div class="col-sm-8">
            <textarea  name="about_the_course"  class="form-control" >{{$course->about_the_course}}</textarea>
        </div>        
    </div>

    <div class="form-group">
        <label for="cover_image_url" class="control-label col-sm-4">Cover image</label>
        <div class="col-sm-8">
            <input   name="cover_image_url" value='{{$course->cover_image_url}}' class="form-control" type="text">
        </div>        
    </div>
   
    <div class="form-group">
        <label for="list_category" class="control-label col-sm-4">Cover image</label>
        <div class="col-sm-8">
            <select  name="list_category" class="form-control" >
                @foreach($list_category as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>        
    </div>
    <input type="submit" class="form-control" value="Create new">
</form>




<!-- Modal -->



@stop
