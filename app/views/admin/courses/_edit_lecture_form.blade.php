<?php

$resources = array();       
$video_path='';
if($lecture->id){
    $video = Resource::where('lecture_id','=',$lecture->id)->where('resource_type_id','=',1)->get();
    
    if(isset($video->path)){
     $video_path = $video->path;
    }
    
    $resources = Resource::where('lecture_id','=',$lecture->id)->where('resource_type_id','!=',1)->get(); 
}


?>

<form id='lecture-form-modal' class="form-horizontal" role="form">
    <input name="chapter_id" type="hidden" value="{{ $lecture->chapter_id }}">
    <input name="id" type="hidden" value="{{ $lecture->id }}">
   

    <div class="form-group ">
        <label for="name" class="control-label col-sm-4">Name</label>
        <div class="col-sm-8">
            <input class="form-control" name="name"  value='{{$lecture->name}}'>
        </div>
    </div>

    <div class="list-resource">
        <div class="btn btn-info add-resource-btn">Add resource</div>
        <ul class="list-unstyled">
            <li>
                <div class="row form-inline">    
                    <div class="col-sm-2">
                        <select name="resourse_type_id" class="form-control" >
                            <option value="1" >Video link</option>
                        </select>
                    </div>
                    
                    <input type="text" name="path" class="form-control col-sm-10" style="width:80%" value="{{$video_path}}">
                </div>
            </li>
            @foreach($resources as $resource)
            <li>
                <div class="row form-inline">

                    <div class="col-sm-2">
                        <select name="resourse_type_id" class="form-control" >
                            <option value="2" >Post link</option>
                            <option value="3" >file pdf</option>
                            <option value="4" >pptx file</option>
                        </select>
                    </div>      
                    
                    <input type="text" name="path" class="form-control col-sm-9" style="width:70%" value="{{ $resource->path }}">

                    <div class="btn btn-danger delete-resource-btn">delete</div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>

</form>
<script>
    $(document).ready(function(){


            $(".add-resource-btn").click(function(){

                $(".list-resource ul").append('<li>'
                    +' <div class="row form-inline">'
                    +'<div class="col-sm-2">'
                        +'<select name="resourse_type_id" class="form-control" >'
                          + ' <option value="1" >Post link</option>'
                          +  '<option value="2" >file pdf</option>'
                          +  '<option value="3" >pptx file</option>'
                        +'</select>'
                   + '</div> ' 
                    +'<input type="text" name="path" class="form-control col-sm-9" style="width:70%">'

                    +'<div class="btn btn-danger delete-resource-btn">delete</div>'
              + ' </div>'
                  +'</li>');
            });
            
            
            $("#lecture-form-modal").delegate('.delete-resource-btn','click',function(){
                $(this).closest("li").remove();
            });



        });
     </script>
