@extends('public.layouts.default')
@section('head')
<script type="text/javascript" src="{{ asset('assets/tinymce/tinymce.min.js'); }}"></script>
<script type="text/javascript" >
tinymce.init({
    selector: "textarea",
    theme: "modern",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern responsivefilemanager"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "| responsivefilemanager | print preview media | forecolor backcolor emoticons",
    image_advtab: true,
    
    external_filemanager_path:"/assets/filemanager/",
    filemanager_title:"Responsive Filemanager",

    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ],
    external_plugins: { 
        filemanager : "/assets/filemanager/plugin.min.js"
    }

    });
   

</script>

@stop

@if($errors->any())
  <div>
    <ul>
      {{ implode('', $errors->all('<li>:message</li>'))}}
    </ul>
  </div>
@endif
 
@section('content')
{{ Form::open(['route' => ['post.store']]) }}
  <div>
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', null) }}
    <hr>

  </div>
  <div>
    {{ Form::submit('Create') }}
  </div>
{{ Form::close() }}




<form method="post" action="somepage">
    <textarea name="content" style="width:100%"></textarea>
</form>
@stop