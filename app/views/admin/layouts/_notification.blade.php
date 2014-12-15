<div class="row">

    <!-- Profile Info and Notifications -->
    <div class="col-md-6 col-sm-8 clearfix">

        <ul class="user-info pull-left pull-none-xsm">

            <!-- Profile Info -->
            <li class="profile-info dropdown">
                <!-- add class "pull-right" if you want to place this from right -->

                <a href="#" class="dropdown-toggle col-sm-12" data-toggle="dropdown">
                    <img src="<?php echo Auth::user()->photo_url; ?>" width="44" class="img-circle">
                    <?php echo Auth::user()->first_name.' '.Auth::user()->last_name; ?>
                </a>

                <ul class="dropdown-menu">

                    <!-- Reverse Caret -->
                    <li class="caret">
                    </li>

                    <!-- Profile sub-links -->
                    <li>
                        <a href="extra-timeline.html">
                            <i class="entypo-user">
                            </i>
                            Edit Profile
                        </a>
                    </li>

                    <li>
                        <a href="mailbox.html">
                            <i class="entypo-mail">
                            </i>
                            Inbox
                        </a>
                    </li>

                    <li>
                        <a href="extra-calendar.html">
                            <i class="entypo-calendar">
                            </i>
                            Calendar
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="entypo-clipboard">
                            </i>
                            Tasks
                        </a>
                    </li>
                </ul>
            </li>

        </ul>

        <ul class="user-info pull-left pull-right-xs pull-none-xsm">

            <!-- Raw Notifications -->
            <li class="notifications dropdown" id="raw-notifications">

                @include('admin.layouts._raw_notifications')

            </li>

            
            
            


        </ul>

    </div>


    <!-- Raw Links -->
    <div class="col-md-6 col-sm-4 clearfix hidden-xs">

        <ul class="list-inline links-list pull-right">


            <li>
                <a href="<?php echo url('logout'); ?>">
                    Log Out <i class="entypo-logout right">
                    </i>
                </a>
            </li>
        </ul>

    </div>

</div>