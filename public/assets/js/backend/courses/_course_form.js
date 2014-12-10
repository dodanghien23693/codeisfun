
$("#course_form #delete-course").click(function(){
        if(confirm("Bạn có chắc chắn muốn xóa không?")==true){
            var course_id = $("#course_form #id").val();
            $.get('<?php echo url('admin/course/delete') ?>',{'id' : course_id},function(response,status){
                if(status=='success'){
                    window.location.replace('<?php echo url('admin/course'); ?>')
                }
                if(status=='error'){
                    alert('That bai');
                }
            });
        }
        
    });
    
    
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




    $(document).ready(function(){
    
    $("select#list_category").multiselect();
    
    
    $("input#name").on('change',function(){
        var name = $(this).val();
        var slug = string_to_slug(name);
        $("input#short_name").val(slug);
    });
    
    $("#course_form").validate({
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
            },
            end_day:{
                required:true,
                date:true,
                greaterThan: ["#start_day","Start Day"]
            },
            cover_image :{
                required:true,
                url:true
            }
            
        },
        
        submitHandler: function(form) {
            alert('chuan bi submit');
          form.preventDefault();
           var id = $('#course_form #id').val(),
            name = $('#course_form #name').val(),
           short_name = $('#course_form #short_name').val(),
           start_day = $('#course_form #start_day').val(),
           end_day = $('#course_form #end_day').val(),
           about_the_course = $('#course_form #about_the_course').val(),
           cover_image_url = $('#course_form #cover_image_url').val();
   
         $("select#list_category").next().find("input:checkbox").each(function(){
            alert($(this).val());
        });
       $.post('<?php echo url('admin/course/edit1/'.$course->id); ?>',{
        id:id,
        name : name, 
        short_name : short_name,
        start_day : start_day,
        end_day : end_day,
        about_the_course:about_the_course,
        cover_image_url:cover_image_url,
        },
        function(response,status){
           if(status=='success'){
              alert('thanh cong');
           }
           if(status=='error'){
               alert('Không thành công');
           }
       });
        }
    });
    
});

