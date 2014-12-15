@extends('admin.layouts.default')

@section('content')


<div id="accept-invite" class="btn btn-info">Accept</div>
<div id="not-accept-invite" class="btn btn-warning">Don't accept</div>


@stop
@section('scripts')
<script>
    $(document).ready(function(){
        $("#accept-invite").click(function(){
            $.post("<?php echo action('CourseController@acceptInvitation',array('course_id'=>$course->id)) ?>").success(function(response,status){
                if(status=='success'){
                   window.location.replace('<?php echo url('admin/course/edit/'.$course->id); ?>');
                }
            });
        });
        
        $("#not-accept-invite").click(function(){
            $.post("<?php echo action('CourseController@rejectInvitation',array('course_id'=>$course->id)) ?>").success(function(){
                
                window.location.replace('<?php echo url('admin/course/edit/'.$course->id); ?>');
            });
        });
    });
    </script>
@stop