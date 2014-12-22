
<div class="sidebar-menu" >


    <header class="logo-env" style="">

        <!-- logo -->
        <div class="logo" style="">
            <a href="index.html">
                <h2 class="text-primary">CodeIsFun</h2>
            </a>
        </div>

        <!-- logo collapse icon -->

        <div class="sidebar-collapse" style="">
            <a href="#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                <i class="entypo-menu"></i>
            </a>
        </div>



        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div class="sidebar-mobile-menu visible-xs">
            <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                <i class="entypo-menu"></i>
            </a>
        </div>

    </header>


    <ul id="main-menu" class="" style="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->


        <li class="root-level " id="dashboard">
            <a href="index.html">
                <i class="entypo-gauge"></i>
                <span style="">Dashboard</span>
            </a>

        </li> 


        <li class="root-level" id="comments">
            <a href="<?php echo url('admin/get-comment'); ?>" >
                <i class="entypo-comment"></i>
                <span style="">Comments</span>
            </a>
        </li>
        
        <li class="root-level" id="comments">
            <a href="index.html" >
                <i class="entypo-user"></i>
                <span style="">Edit profile</span>
            </a>
        </li>

    </ul>

</div>

