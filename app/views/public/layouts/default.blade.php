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
    @include("public.layouts._styles")
    
    
    
    <!-- Favicons
    ================================================== -->
    <link rel="shortcut icon" href="<?php echo URL::to("assets/favicon.ico"); ?>" />
          
          
</head>

<body>
    <!-- Primary Page Layout
    ================================================== -->

    <!-- BEGIN WRAPPER -->
    <div id="wrapper">

            <!-- BEGIN HEADER -->
            @include("public.layouts._header")
            <!-- END HEADER -->

            @section('slider')
               
            @show

            @section('heading')
                
            @show

            <!-- BEGIN CONTENT HOLDER -->
           
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                @yield('content')
                    </div>
                <div>
            
            <!-- END CONTENT HOLDER -->

            @include("public.layouts._footer")

    </div>
    <!-- END WRAPPER -->

    <!-- Javascript Files
    ================================================== -->
    @include("public.layouts._scripts")    
</body>

</html>