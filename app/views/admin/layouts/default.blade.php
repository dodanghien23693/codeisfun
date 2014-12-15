<html>
<head>
   
    
    <meta charset="utf-8">
    <title></title>
    
    @section('meta_description')
    
    @show
    
    @section('meta-keywords')   
    
    @show
    
    <!-- Mobile Specific Metas
  ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    
    @section('head')
    
    @show
    
    
    <!-- CSS
  ================================================== -->
    @include("admin.layouts._styles")

  
</head>

<body class="page-body" >
    <!-- Primary Page Layout
    ================================================== -->
    

   <div class="page-container">
       @include("admin.menu.menu")
       
       <div class="main-content"  >
         @include("admin.layouts._notification")
           
           <div id="main-content-ajax">
             <!-- main content -->

           @section('content')
              
           
           @show
             <!-- end main content -->
           </div>  
         <?php //  @include("admin.layouts._footer")  ?>
       </div>
       
       <!-- chat section -->
      <?php // @include("admin.layouts._chat") ?>
       <!-- end chat section -->
       
   </div>

   
    @include("admin.layouts._scripts")    
</body>

</html>