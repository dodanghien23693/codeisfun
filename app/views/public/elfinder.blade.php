<html>
    <head>
        <link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/smoothness/jquery-ui.css" />


        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset('elfinder/css/elfinder.min.css'); ?>">
    

<!-- Mac OS X Finder style for jQuery UI smoothness theme (OPTIONAL) -->
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset('elfinder/css/theme.css'); ?>">
    </head>
    <body>
        
       
        
        
        
  <script >
    $(document).ready(function() {
        var elf = $('#elfinder').elfinder({
            // lang: 'ru',             // language (OPTIONAL)
            url : '<?php echo asset('elfinder/php/connector.php')?>'  // connector URL (REQUIRED)
        }).elfinder('instance');            
    });
</script>

<!-- Element where elFinder will be created (REQUIRED) -->
<div id="elfinder"></div>
        
        <script type="text/javascript" src="<?php echo asset('elfinder/js/elfinder.min.js'); ?>"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" ></script> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js"></script>
    </body>
</html>
