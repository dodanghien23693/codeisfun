<html>
    <head>

   </head>
    <body>
        


<!-- Element where elFinder will be created (REQUIRED) -->
<textarea></textarea>

<script type="text/javascript" src="{{ url('filemanager') }}/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="{{ url('filemanager') }}/tinymce/tinymce_editor.js"></script>
<script type="text/javascript">
editor_config.selector = "textarea";
tinymce.init(editor_config);
</script>        

        </body>
</html>
