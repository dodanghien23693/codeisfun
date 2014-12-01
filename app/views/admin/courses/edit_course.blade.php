@extends('admin.layouts.default')
@section('content')

<?php 
   
    $chapters = $course->chapters()->orderBy('order_of_chapter')->get();
    
?>

<div id='course-tab' class="panel panel-primary" data-collapsed="0">

    <div class="panel-heading">
        <div class="panel-title">
            Course info
        </div>

        <div class="panel-options">
            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
        </div>
    </div>
    
    <div id="course-tab-content" class="panel-body">
        @include("admin.courses._course_form")
    </div>
</div>


<div id='chapter-tab' class="panel panel-info" data-collapsed="0">

    <div class="panel-heading">
        <div class="panel-title">
            Edit chapter
        </div>

        <div class="panel-options">
            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
        </div>
    </div>
    
    <div id="chapter-tab-content" class="panel-body">
        @include("admin.courses._chapter_form")
    </div>
</div>



<div id='lecture-tab' class="panel panel-warning" data-collapsed="0">

    <div class="panel-heading">
        <div class="panel-title">
            Edit lecture
        </div>

        <div class="panel-options">
            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
        </div>
    </div>
    
    <div id="lecture-tab-content" class="panel-body">
        @include("admin.courses._lecture_form")
    </div>
</div>

@stop
