
<div class="tabs-vertical-env">

    <ul class="nav tabs-vertical">
        <li> <h2>Chapter</h2></li><!-- available classes "right-aligned" -->
        @foreach($chapters as $chapter)
        <li ><a href="#chapter<?php echo $chapter->id; ?>" data-toggle="tab">{{$chapter->name}}</a></li>
        @endforeach
    </ul>
    <div class="tab-content">
        @foreach($chapters as $chapter)
        <?php
            $lectures = Lecture::where('chapter_id', '=', $chapter->id)->orderBy('order_of_lecture')->get();
        ?>
        <div class="tab-pane" id="chapter<?php echo $chapter->id; ?>" chapter-id="<?php echo $chapter->id; ?>">   
            <div  class="btn btn-info create-lecture-btn" >Create new lecture</div>
            <div  class="nested-list dd with-margins custom-drag-button list-lecture"><!-- adding class "with-margins" will separate list items -->			
                <ul class="dd-list list">       
                    @foreach($lectures as $lecture)
                    <li class="dd-item list-group-item" data-id="{{ $lecture->id }}" >  

                        <div class="dd-handle">    
                            <span>.</span>     
                            <span>.</span>  
                            <span>.</span>  
                        </div>
                        <div class="dd-content">

                            <div class="col-sm-9 lecture-name">
                                {{ $lecture->name }}
                            </div>
                            <div class="btn btn-info edit-lecture-btn" >Edit</div>
                            <div class="btn btn-danger delete-lecture-btn" >Delete</div>       
                        </div>
                    </li>  
                    @endforeach

                </ul>
                <div  class="btn btn-info update-order-lecture">Update order of lecture</div>

            </div>
        </div>
        
        @endforeach
    </div>

</div>

<script>

    $(document).ready(function() {
        $(".list-lecture").nestable({
            maxDepth: 1,
        });


        function registerEventLecture() {

            $(".delete-lecture-btn").click(function() {
                if (window.confirm("Bạn có chắc chắn muốn xóa lecture này không?") == true) {
                    var lecture_id = $(this).closest('.dd-item').attr('data-id');
                    $.post('<?php echo url('admin/lecture/delete') ?>', {lecture_id: lecture_id}, function(response, status) {
                        if (status == 'success') {

                            $('.dd-item[data-id=' + lecture_id + ']').remove();
                        }
                        if (status == 'error') {
                            alert('xoa that bai');
                        }
                    });
                }
            });

            $('.edit-lecture-btn').click(function(event) {   
                event.preventDefault();
                var lecture_id = $(this).closest(".dd-item").attr('data-id');
                $('#edit-lecture-modal').modal('show');
                $("#edit-lecture-modal .modal-footer button").addClass('update-lecture-modal-btn');
                $("#edit-lecture-modal .modal-footer button").removeClass('create-lecture-modal-btn');
                $('#edit-lecture-modal .modal-body').html('Is loading.......');
                $.get('<?php echo url('admin/lecture/get-edit-form'); ?>', {lecture_id: lecture_id}, function(response, status) {
                    if (status == 'success') {
                        $('#edit-lecture-modal .modal-body').html(response);
                    }
                });
            });

        }



        registerEventLecture();

         function getListResource(){
           var list_resource = {};
            $(".list-resource .form-inline").each(function(index){
                list_resource[index] = {resource_type_id : $(this).find("select").val(), path: $(this).find("input[name='path']").val() };
            });
            return JSON.stringify(list_resource);
        }
        
        $(".create-lecture-btn").click(function() {

            $("#edit-lecture-modal").modal('show');
            $("#edit-lecture-modal .modal-footer button").addClass('create-lecture-modal-btn');
            $("#edit-lecture-modal .modal-footer button").removeClass('update-lecture-modal-btn');
            var chapter_id = $(this).closest('.tab-pane').attr('chapter-id');
            $('#edit-lecture-modal .modal-body').html('Is loading.......');
            $.get('<?php echo url('admin/lecture/get-edit-form'); ?>',{chapter_id : chapter_id},function(response, status){
                if (status == 'success') {
                    $('#edit-lecture-modal .modal-body').html(response);
                }
            });
        });



        $("#edit-lecture-modal").delegate(".create-lecture-modal-btn",'click',function(e) {
            e.preventDefault();
            var chapter_id = $("#lecture-form-modal input[name='chapter_id']").val();
            var name = $("#lecture-form-modal input[name='name']").val();
            var list_resource = getListResource();
            var lecture_list = $("#chapter"+chapter_id+" .list-lecture ul");
           
            $.post('<?php echo url("admin/lecture/edit"); ?>', {action: "create", chapter_id: chapter_id, name: name, list_resource:list_resource}, function(response, status) {
                if (status == 'success') {
                    
                    var newItem = '<li class="dd-item list-group-item" data-id="' + response.lecture_id + '" >'

                            + '<div class="dd-handle">  '
                            + '<span>.</span> '
                            + '<span>.</span> '
                            + '<span>.</span> '
                            + '</div>'
                            + '<div class="dd-content">'
                            + '<div class="col-sm-9 lecture-name">'
                            + name
                            + '</div>'
                            + '<div class="btn btn-info edit-lecture-btn" >Edit</div>'
                            + '<div class="btn btn-danger delete-lecture-btn" >Delete</div>  '
                            + '</div>'
                            + '</li>';

                    $(lecture_list).append(newItem);
                    registerEventLecture();
                    $("#edit-lecture-modal").modal('hide');
                }
                if (status == 'error') {

                }
            });

        });


       
        
        $("#edit-lecture-modal").delegate('.update-lecture-modal-btn','click',function() {
            var id = $("#lecture-form-modal input[name='id']").val();
            var name = $("#lecture-form-modal input[name='name']").val();
            var list_resource = getListResource();

            $.post('<?php echo url('admin/lecture/edit') ?>', {action: "update",id: id, name: name, list_resource : list_resource}, function(response, status) {
                if (status == 'success') {
                    $(".list-lecture .dd-item[data-id='" + id + "'] .lecture-name").html(name);
                    $("#edit-lecture-modal").modal('hide');
                }
                if (status == 'error') {
                    alert('that bai');
                }
            });
        });

        $('.update-order-lecture').click(function() {

            var order = window.JSON.stringify($(this).closest('.list-lecture').nestable('serialize'));
            var chapter_id = $(this).closest('.tab-pane').attr('chapter-id');

            $.post('<?php echo url('admin/chapter/update-order-lecture') ?>', {order_lecture: order, chapter_id: chapter_id}, function(response, status) {
                if (status == 'success') {

                    alert(response);
                }
                if (status == 'error') {
                    alert('cập nhật thất bại');
                }

            });

        });


    });
</script>



