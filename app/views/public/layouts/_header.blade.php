<header id="header">


    <!--Main Header-->
    <div id="main-header">
        <div class="container">
            <div class="grid_12">

                <!-- BEGIN LOGO -->
                <div id="logo">
                    <!-- Image based Logo-->
                    <a href="{{ url('/') }}"><img src="{{URL::to("assets/public/default/images/logo.png")}}" alt=""/></a>

                </div>
                <!-- END LOGO -->

                <!-- BEGIN NAVIGATION -->
                @include("public.layouts._top_nav")
                <!-- END NAVIGATION -->

            </div>
        </div>
    </div>

</header>
