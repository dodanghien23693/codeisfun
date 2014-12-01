<?php //Nhận về biến $categories chứa mảng 
?>
@extends('admin.layouts.default')
@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            Add new category
        </div>
         <div class="panel-options">
            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
            
        </div>
    </div>
    
    <div class="panel-body">
        <div class="col-sm-6 col-sm-offset-3">
        <form id="create-category-form" action="<?php echo url('admin/category'); ?>" method="POST" role="form">
            <div class="form-group form-horizontal">
                <label for="name" class="control-label col-sm-4">Name</label>
                <div class="col-sm-8">
                <input class="form-control" name="name" id="name"/>
                </div>
            </div>    
            
             <div class="form-group form-horizontal">
                <label for="slug" class="control-label col-sm-4">Slug</label>
                <div class="col-sm-8">
                <input class="form-control" name="slug" id="slug"/>
                </div>
            </div>    
            
             <div class="form-group form-horizontal">
                <label for="description" class="control-label col-sm-4">Description</label>
                <div class="col-sm-8">
                <input class="form-control" name="description" id="description"/>
                </div>
            </div>    
            
            <div class="btn btn-default col-sm-offset-5" id="create-new-category">Create new </div>
            
        </form>
             
    </div>
    </div>
    
    
</div>


<div id='order-category-area' class="panel panel-primary" data-collapsed="0">

    <div class="panel-heading">
        <div class="panel-title">
            Modify order
        </div>

        <div class="panel-options">
            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
            <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
        </div>
    </div>
    
    <div class="panel-body">
        <div id="list-category" class="nested-list dd with-margins custom-drag-button"><!-- adding class "with-margins" will separate list items -->			
            <ul class="dd-list">
                @foreach($categories as $category)
                <li class="dd-item" data-id="{{ $category['id'] }}" >
                    <div class="dd-handle">
                        
                    </div>
                    <div class="dd-content">
                       
                        <div class="col-sm-10">
                        {{ $category['name'] }}
                        </div>
                        <div class="btn btn-info edit-category-btn">Edit</div>
                        <div class="btn btn-danger delete-category-btn">Delete</div>
                        
                    </div>
                </li>

                @endforeach
            </ul>
        </div>
        <div class="btn btn-info" id='update-order-category'>Update</div>
    </div>
    
</div>

@stop
@section('scripts') 
 
<script>
  $(document).ready(function(){
      
    $('#list-category').nestable({
        
    });
    
    function registerEventCategory(){
        $(".delete-category-btn").click(function(){
       
        var category = $(this).closest(".dd-item");
        var category_id = $(category).attr('data-id');
        alert(category_id);
        $.post('<?php echo url('admin/category/delete') ?>',{category_id:category_id},function(response,status){
            if(status=='success'){
                alert('xoa thanh cong');
                $(category).remove();
            }
            if(status=='error'){
                alert('that bai');
            }
        });
        });
    }
    registerEventCategory();
    
        $('#update-order-category').click(function(){
        var order = window.JSON.stringify($('.dd').nestable('serialize'));
        $.post('<?php echo url('admin/update-order-category') ?>',{data: order },function(result){
            alert(result);
        });
        
        });
        
        $("#create-new-category").click(function(){

        var name = $("#create-category-form input[name='name']").val();
        var slug = $("#create-category-form input[name='slug']").val();
        var description = $("#create-category-form input[name='description']").val();
        alert(name+slug+description);
        var list_category = $("#list-category ul");
        $.post('<?php  echo url('admin/category/new'); ?>',{'name' : name, 'slug' : slug, 'description' : description},function(response,status){
            if(status=='success'){
                var newItem = '<li class="dd-item" data-id="'+response.category_id+'" >'
                    +'<div class="dd-handle">'
                        
                    +'</div>'
                    +'<div class="dd-content">'
                        +'<div class="col-sm-10">'
                           + name
                        +'</div>'
                        +'<div class="btn btn-info edit-category-btn">Edit</div>'
                        +'<div class="btn btn-danger delete-category-btn">Delete</div>'  
                    +'</div>'
               +' </li>';
                
                $(list_category).append(newItem);
                registerEventCategory();
                alert('thanh cong');
            }
            if(status=='error'){
                alert('Thêm thất bại');
            }
        } );
       
    });
    
    });
    

</script>

 
@stop

