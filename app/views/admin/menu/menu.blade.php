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

        <!-- Post manager -->
        <li class="root-level has-sub" id="posts">
            <a href="layout-api.html">
                <i class="entypo-newspaper"></i>
                <span style="">Posts</span>
            </a>
            <ul>
                <li id="all-post">
                    <a href="<?php echo url('admin/post');?>">
                        <span style="">All Posts</span>
                    </a>
                </li>
                <li id="new-post">
                    <a href="<?php echo url('admin/post/create');?>">
                        <span style="">New Post</span>
                    </a>
                </li>

            </ul>
        </li>
        <!-- end Post manager -->


        <!-- Course manager -->
        <li class="root-level has-sub" >
            <a href="layout-api.html">
                <i class="entypo-play"></i>
                <span >Courses</span>
            </a>
            <ul >
                <li id="all-course">
                    <a href="<?php echo url('admin/course') ?>">
                        <span style="">All Courses</span>
                    </a>
                </li>
                <li id="new-course">
                    <a href="<?php echo url('admin/course/new') ?>">
                        <span >New Course</span>
                    </a>
                </li>
                
            </ul>
        </li>
        <!-- end Course manager -->

        <li class="root-level" >
            <a href="<?php echo url('admin/category') ?>" id="categories" >
                <i class="entypo-bookmarks"></i>
                <span >Categories</span>
            </a>
        </li>

        <li class="root-level" id="tags">
            <a href="<?php echo url('admin/tag');?>" >
                <i class="entypo-tag"></i>
                <span style="">Tags</span>
            </a>
        </li>

        <li class="root-level" id="comments">
            <a href="index.html" >
                <i class="entypo-comment"></i>
                <span style="">Comments</span>
            </a>
        </li>

        <li class="root-level" id="media-manager">
            <a href="/filemanager/dialog.php" \>
                <i class="entypo-video"></i>
                <span style="">Media Manager</span>
            </a>
        </li>

        <li class="root-level" id="user-manager">
            <a href="<?php echo url('admin/user') ?>" >
                <i class="entypo-users"></i>
                <span style="">User Manager</span>
            </a>
        </li>

        <li class="root-level" id="activities">
            <a href="index.html" target="_blank">
                <i class="glyphicon glyphicon-tasks"></i>
                <span style="">Activities</span>
            </a>
        </li>

        <li class="root-level" id="statistics">
            <a href="index.html" target="_blank">
                <i class="entypo-chart-line"></i>
                <span style="">Statistics</span>
            </a>
        </li>

        <li class="root-level has-sub" id="mailbox">
            <a href="mailbox.html">
                <i class="entypo-mail"></i>
                <span>Mailbox</span>
                <span class="badge badge-secondary">8</span>
            </a>
            <ul >
                <li id="mailbox-inbox">
                    <a href="mailbox.html">
                        <i class="entypo-inbox"></i>
                        <span>Inbox</span>
                    </a>
                </li>
                <li id="mailbox-compose-message">
                    <a href="mailbox-compose.html">
                        <i class="entypo-pencil"></i>
                        <span>Compose Message</span>
                    </a>
                </li>
                <li id="mailbox-view-message">
                    <a href="mailbox-message.html">
                        <i class="entypo-attach"></i>
                        <span>View Message</span>
                    </a>
                </li>
            </ul>
        </li>

    </ul>

</div>

