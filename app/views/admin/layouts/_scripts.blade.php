 <!-- GLOBAL SCRIPTS -->
    <script src="<?php echo asset('assets/backend/js/gsap/main-gsap.js'); ?>"></script>
    
    
	<script src="<?php echo asset('assets/backend/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js'); ?>"></script>
	<script src="<?php echo asset('assets/backend/js/bootstrap.js'); ?>"></script>
	<script src="<?php echo asset('assets/backend/js/joinable.js'); ?>"></script>
	<script src="<?php echo asset('assets/backend/js/resizeable.js'); ?>"></script>
	<script src="<?php echo asset('assets/backend/js/neon-api.js'); ?>"></script>
        
    
       
        <script src="<?php echo asset('assets/backend/js/jquery.dataTables.min.js'); ?>"></script>
        
        <script src="<?php echo asset('assets/backend/js/jquery.nestable.js'); ?>"></script>
        <script src="<?php echo asset('assets/backend/js/neon-chat.js'); ?>"></script>
	<script src="<?php echo asset('assets/backend/js/neon-custom.js'); ?>"></script>
	<script src="<?php echo asset('assets/backend/js/neon-demo.js'); ?>"></script>
        
        
        <script type="text/javascript" src="/tinymce/tinymce.min.js"></script>
        <script type="text/javascript" src="/tinymce/tinymce_editor.js"></script>
        
        
       
      
    <!-- END GLOBAL SCRIPTS -->

<script type="text/javascript">
editor_config.selector = "textarea";
tinymce.init(editor_config);
</script>
    <!-- PAGE LEVEL SCRIPTS -->
    @section('scripts')
   
    @show
    <!-- END PAGE LEVEL SCRIPTS -->



