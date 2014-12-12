@extends('admin.layouts.default')
@section('content')

<form id="new-course-form" role='form' action="<?php echo url('admin/course/new'); ?>" method="post" class="form-horizontal" accept-charset="UTF-8" enctype="multipart/form-data" novalidate="novalidate">
  
    <input type="hidden" id="user_id" name="user_id" value="<?php echo Auth::id(); ?>">
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
            <div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden">
                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                            <img src="http://placehold.it/200x150" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 6px;"></div>
                    <div>
                            <span class="btn btn-white btn-file">
                                    <span class="fileinput-new">Select image</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input type="file" name="cover_image" accept="image/*">
                            </span>
                    </div>
            </div>
            
            <!-- <input   name="cover_image_url" value='{{$course->cover_image_url}}' class="form-control" type="file"> -->
        </div>        
    </div>
   
    <div class="form-group">
        <label for="list_category" class="control-label col-sm-4">Categories</label>
        <div class="col-sm-8">
            <select  id="list_category" name="categories[]" class="form-control" multiple="multiple">
                @foreach($list_category as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>        
    </div>
    
    <div class="form-group">
        <label for="list_writer" class="control-label col-sm-4">Invite Writer</label>
        <div class="col-sm-8">
            <select  id="list_writer" name="writers[]" class="form-control" multiple="multiple">
                @if(isset($list_writer)) 
                @foreach($list_writer as $writer)
                <option value="{{$writer->id}}">{{$writer->username}}</option>
                @endforeach
                @endif
            </select>
        </div>        
    </div>
    <div class="submit-area">
      <input type="submit" class="form-control" value="Create new">
    </div>
</form>




<!-- Modal -->



@stop

@section('scripts')

<script>
    
jQuery.validator.addMethod("greaterThan", function(value, element, params) {
    if ($(params[0]).val() != '') {    
        if (!/Invalid|NaN/.test(new Date(value))) {
            return new Date(value) > new Date($(params[0]).val());
        }    
        return isNaN(value) && isNaN($(params[0]).val()) || (Number(value) > Number($(params[0]).val()));
    };
    return true; 
},'Must be greater than {1}.');

function string_to_slug(str) {
  str = str.replace(/^\s+|\s+$/g, ''); // trim
  str = str.toLowerCase();
  
  // remove accents, swap ñ for n, etc
  var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
  var to   = "aaaaeeeeiiiioooouuuunc------";
  for (var i=0, l=from.length ; i<l ; i++) {
    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
  }

  str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
    .replace(/\s+/g, '-') // collapse whitespace and replace by -
    .replace(/-+/g, '-'); // collapse dashes

  return str;
}

$("input#name").change(function(){
    $("input#slug").val(string_to_slug($(this).val()));
});

    function today(){
        var now = new Date();
        var month = (now.getMonth() + 1);               
        var day = now.getDate();
        if(month < 10) 
            month = "0" + month;
        if(day < 10) 
            day = "0" + day;
        var today = now.getFullYear() + '-' + month + '-' + day;
        return today;
    }
    
    function getStartDay(){
        alert($("#start_day").val());
        return $("#start_day").val();
    }
    
    function string_to_slug(str) {
      str = str.replace(/^\s+|\s+$/g, ''); // trim
      str = str.toLowerCase();

      // remove accents, swap ñ for n, etc
      var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
      var to   = "aaaaeeeeiiiioooouuuunc------";
      for (var i=0, l=from.length ; i<l ; i++) {
        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
      }

      str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
        .replace(/\s+/g, '-') // collapse whitespace and replace by -
        .replace(/-+/g, '-'); // collapse dashes

      return str;
    }

    $(document).ready(function(){
    
    
    
    $("select#list_category").multiselect();
    
    $("select#list_writer").multiselect({
        enableFiltering: true
    });
    
    $("input#name").on('change',function(){
        var name = $(this).val();
        var slug = string_to_slug(name);
        $("input#short_name").val(slug);
    });
    
    $("#new-course-form").validate({
        rules : {
            name : {
                required : true,
                minlength:5
            },
            short_name : {
                required : true,
            },
            start_day:{
                required:true,
                date:true,
                min : today()
            },
            end_day:{
                required:true,
                date:true,
                greaterThan: ["#start_day","Start Day"]
            },
            cover_image :{
                required:true
               
            }
            
            
        }
    });
    
});

</script>
@stop
