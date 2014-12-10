@include('admin.layouts._styles')
<?php

$resources = array();       
$video_path='';
if($lecture->id){
    
    $video = Lecture::find($lecture->id)->resources()->first();
    if(isset($video->path)){
     $video_path = $video->path;
    }
    
    $resources = Resource::where('lecture_id','=',$lecture->id)->where('resource_type_id','!=',1)->get(); 
}
?>

<form id='lecture-form-modal' class="form-horizontal" method="post" action="<?php echo url('admin/lecture/add-resource') ;?>" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
    <input name="chapter_id" type="hidden" value="{{ $lecture->chapter_id }}">
    <input name="id" type="hidden" value="{{ $lecture->id }}">
    <input name="count" type="hidden" value="1">

    <div class="form-group " style="display: none">
        <label for="name" class="control-label col-sm-4">Name</label>
        <div class="col-sm-8">
            <input  class="form-control" name="name"  value='{{$lecture->name}}'>
        </div>
        
    </div>

    <div class="list-resource">
        <div class="btn btn-info add-resource-btn">Add resource</div>
        <div class="col-sm-10 col-sm-offset-1">
        <ul class="list-unstyled">
            <li>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-2"  style="padding-right: 0px">
                            <select name="resource_type_id1" class="form-control btn btn-default" >
                               <option value="1" >Video link</option>
                            </select>
                        </div>
                        <div class="col-sm-8" style="padding-left: 0px; padding-right: 0px">
                            <div id="input-lecture-field" class="fileinput fileinput-new" data-provides="fileinput"  style="display:none">
                                <span class="btn btn-info btn-file">
                                        <span class="fileinput-new">Select file</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="upload_file1" accept="video/*">
                                </span>
                                <span class="fileinput-filename"></span>
                                <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a>
                            </div>
                            <input type="text" placeholder="URL" name="path1" class="form-control" value="{{ $video_path }}">
                        </div>
                        <div class="col-sm-2"  style="padding-left: 0px;">
                            <select class="form-control lecture-action" name="method1" >
                                   <option value="1" >Upload</option>
                                   <option value="2" selected>URL</option>
                             </select>
                        </div>
                    </div>
                </div>
            </li>
            <?php $i=2; ?>
            @foreach($resources as $resource)
            
            <li>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-2"  style="padding-right: 0px">
                            <select name="resource_type_id<?php echo $i++; ?>" class="form-control" value="{{$resource->resource_type_id}}">
                                <option value="2" >file pdf</option>
                                <option value="3" >file pptx</option>
                                <option value="4" >Post link</option>
                            </select>
                        </div>
                        <div class="col-sm-8" style="padding-left: 0px; padding-right: 0px">
                            <div id="input-lecture-field" class="fileinput fileinput-new" data-provides="fileinput" style="display:none">
                                <span class="btn btn-info btn-file">
                                        <span class="fileinput-new">Select file</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="upload_file<?php echo $i++; ?>" >
                                </span>
                                <span class="fileinput-filename"></span>
                                <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a>
                            </div>
                            <input type="text" placeholder="URL" name="path<?php echo $i++; ?>" class="form-control" value="{{$resource->path}}">
                        </div>
                        <div class="col-sm-2"  style="padding-left: 0px;">
                            <select class="form-control lecture-action"  name="method<?php echo $i++; ?>" >
                                   <option value="1" >Upload</option>
                                   <option value="2" selected>URL</option>
                                   <option value="3" >Delete</option>
                             </select>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
       </div>
        
   </div>
    <input type="submit" value="submit" class="form-control bottom-right">
</form>
@include('admin.layouts._scripts')
<script src="<?php echo asset('assets/backend/js/bootstrap-switch.min.js'); ?>"></script>
<script src="<?php echo asset('assets/backend/js/fileinput.js'); ?>"></script>

<script>
    $(document).ready(function(){
 
            $(".list-resource").delegate(".lecture-action",'change',function(){
                var sl = $(this);
                if($(this).val()=='1'){
                    var rs_type = $(this).closest(".form-group").find("select[name*='resource_type_id']").val();
                    
                    
                    if(rs_type=='4')
                    {
                        $(sl).val('2');
                    }
                    else{
                         $(this).closest(".form-group").find("#input-lecture-field").show(300);
                         $(this).closest(".form-group").find("input:text").hide(300);
                    }
                   
                }
                if($(this).val()=='2'){
                  
                    $(this).closest(".form-group").find("#input-lecture-field").hide(300);
                    $(this).closest(".form-group").find("input:text").show(300);
                }
                if($(this).val()=='3'){
                    $(this).closest("li").remove();
                }
            });
            
            
            $(".list-resource").delegate("select[name*='resource_type_id']",'change',function(){
               
                var sl = $(this);
                if($(sl).val()=='4'){
                    if($(sl).closest(".form-group").find(".lecture-action").val()=='1'){
                        
                        $(sl).closest(".form-group").find(".lecture-action").val('2');
                        $(this).closest(".form-group").find("#input-lecture-field").hide(300);
                    $(this).closest(".form-group").find("input:text").show(300);
                        
                    }
                }
                
            });

            $("#lecture-form-modal").on('submit',function(){
                 $("#lecture-form-modal input[name='count']").val($(".list-resource .lecture-action").length);
                 
            });
            
            $(".add-resource-btn").click(function(){

                var i = $(".list-resource .lecture-action").length +1;
                $(".list-resource ul").append(
                '<li>'
                +'<div class="form-group">'
                    +'<div class="row">'
                        +'<div class="col-sm-2"  style="padding-right: 0px">'
                            +'<select name="resource_type_id'+i+'" class="form-control btn btn-default" >'
                               +'<option value="2" >file pdf</option>'
                                +'<option value="3" >file pptx</option>'
                                +'<option value="4" >Post link</option>'
                            +'</select>'
                        +'</div>'
                        +'<div class="col-sm-8" style="padding-left: 0px; padding-right: 0px">'
                            +'<div id="input-lecture-field" class="fileinput fileinput-new" data-provides="fileinput">'
                                +'<span class="btn btn-info btn-file">'
                                        +'<span class="fileinput-new">Select file</span>'
                                        +'<span class="fileinput-exists">Change</span>'
                                        +'<input type="file" name="upload_file'+i+'">'
                                +'</span>'
                                +'<span class="fileinput-filename"></span>'
                                +'<a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a>'
                            +'</div>'
                            +'<input type="text" placeholder="URL" name="path'+i+'" class="form-control" style="display:none">'
                        +'</div>'
                        +'<div class="col-sm-2"  style="padding-left: 0px;">'
                            +'<select class="form-control lecture-action" name="method'+i+'" value="1">'
                                   +'<option value="1" >Upload</option>'
                                   +'<option value="2" >URL</option>'
                                   +'<option value="3" >Delete</option>'
                             +'</select>'
                        +'</div>'
                    +'</div>'
                +'</div>'
            +'</li>');
            });
            
            
            $("#lecture-form-modal").delegate('.delete-resource-btn','click',function(){
                $(this).closest("li").remove();
            });

        });
     </script>
