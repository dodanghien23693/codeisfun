<html>
<head>
    <meta charset="utf-8">
    <title>{{-- Services\MenuManager::getTitle($title) --}}</title>
    
    @section('meta_description')
    {{-- here goes the meta_description --}}
    @show
    
    @section('meta-keywords')   
    {{-- Here goes the meta_keywords --}}
    @show
    
    <!-- Mobile Specific Metas
  ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
  ================================================== -->
    @include("public.layouts._styles")

    <!-- Favicons
    ================================================== -->
    <link rel="shortcut icon" href="{{URL::to("assets/favicon.ico")}}">
          
          
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
                {{-- Here goes the slider --}}
            @show

            @section('heading')
                {{-- Here goes the heading --}}
            @show

            <!-- BEGIN CONTENT HOLDER -->
            <div id="content-wrapper" class="large-text">

                @yield('content')

            </div>
            <!-- END CONTENT HOLDER -->

            @include("public.layouts._footer")

    </div>
    <!-- END WRAPPER -->

    <!-- Javascript Files
    ================================================== -->
    @include("public.layouts._scripts")    
</body>

</html>