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

<body class="page-body settings-pane-open" >
    <!-- Primary Page Layout
    ================================================== -->
    
    <!-- settings pane -->
    @include("admin.layouts._settings")    
   <!-- end settings pane -->
   <div class="page-container">
       @include("admin.menu.menu")
       
       <div class="main-content">
           @include("admin.layouts._notification")
           
             <!-- main content -->
           @yield('content')
             <!-- end main content -->
             
           @include("admin.layouts._footer")  
       </div>
       
       <!-- chat section -->
       @include("admin.layouts._chat")
       <!-- end chat section -->
       
   </div>

    ================================================== -->
    @include("admin.layouts._scripts")    
</body>

</html>