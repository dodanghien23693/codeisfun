<?php
$notifications = Auth::user()->notifications()->orderBy('updated_at','DSC')->get(array('description','link','user_notification.is_read','notifications.updated_at','model_type','model_id','type_notification_id'));

?>

<a href="#" id="list-notification-btn" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <i class="entypo-attention">
                    </i>
                    <span class="number-notifications-badge" >
                       
                    </span>
                </a>

<ul class="dropdown-menu" >
                    <li class="top">
                        <p class="small">
                            <a href="#" class="pull-right mark-all-read">Mark all Read</a>
                            You have <strong class="number-notifications"></strong> new notifications.
                        </p>
                    </li>

                    <li>
                        <ul id="list-notification" class="dropdown-menu-list scroller" tabindex="5001" style="overflow: hidden; outline: none;">
                            <?php 
                                            function time2str($ts)
                                            {
                                                if(!ctype_digit($ts))
                                                    $ts = strtotime($ts);
                                                
                                                $diff = time() - $ts;
                                                if($diff == 0)
                                                    return 'now';
                                                elseif($diff > 0)
                                                {
                                                    $day_diff = floor($diff / 86400);
                                                    if($day_diff == 0)
                                                    {
                                                        if($diff < 60) return 'just now';
                                                        if($diff < 120) return '1 minute ago';
                                                        if($diff < 3600) return floor($diff / 60) . ' minutes ago';
                                                        if($diff < 7200) return '1 hour ago';
                                                        if($diff < 86400) return floor($diff / 3600) . ' hours ago';
                                                    }
                                                    if($day_diff == 1) return 'Yesterday';
                                                    if($day_diff < 7) return $day_diff . ' days ago';
                                                    if($day_diff < 31) return ceil($day_diff / 7) . ' weeks ago';
                                                    if($day_diff < 60) return 'last month';
                                                    return date('F Y', $ts);
                                                }
                                                else
                                                {
                                                    $diff = abs($diff);
                                                    $day_diff = floor($diff / 86400);
                                                    if($day_diff == 0)
                                                    {
                                                        if($diff < 120) return 'in a minute';
                                                        if($diff < 3600) return 'in ' . floor($diff / 60) . ' minutes';
                                                        if($diff < 7200) return 'in an hour';
                                                        if($diff < 86400) return 'in ' . floor($diff / 3600) . ' hours';
                                                    }
                                                    if($day_diff == 1) return 'Tomorrow';
                                                    if($day_diff < 4) return date('l', $ts);
                                                    if($day_diff < 7 + (7 - date('w'))) return 'next week';
                                                    if(ceil($day_diff / 7) < 4) return 'in ' . ceil($day_diff / 7) . ' weeks';
                                                    if(date('n', $ts) == date('n') + 1) return 'next month';
                                                    return date('F Y', $ts);
                                                }
                                            }
                            ?>
                            
                            

                        </ul>
                    </li>

                    <li class="external">
                        <a href="#">View all notifications</a>
                    </li>				<div id="ascrail2001" class="nicescroll-rails" style="padding-right: 3px; width: 10px; z-index: 1000; position: absolute; top: 0px; left: -10px; height: 0px; cursor: default; display: none;">
                        <div style="position: relative; top: 0px; float: right; width: 5px; height: 0px; border: 1px solid rgb(204, 204, 204); border-radius: 1px; background-color: rgb(212, 212, 212); background-clip: padding-box;">
                        </div>
                    </div>
                    <div id="ascrail2001-hr" class="nicescroll-rails" style="height: 7px; z-index: 1000; top: -7px; left: 0px; position: absolute; cursor: default; display: none;">
                        <div style="position: relative; top: 0px; height: 5px; width: 0px; border: 1px solid rgb(204, 204, 204); border-radius: 1px; background-color: rgb(212, 212, 212); background-clip: padding-box;">
                        </div>
                    </div>
                </ul>

<script>
    
    
    
    $(document).ready(function(){
        var last_update;
        var number_new_notis = 0;
       function getNotifications()
        {
            $.get('<?php echo url('admin/notification'); ?>',function(response,status){
                if(status=='success'){
                    
                    
                    var notifications = response.notifications;
                    number_new_notis = response.number_new_notis;
                    
                    
                    if(number_new_notis > 0)
                    {
                        $(".number-notifications-badge").addClass('badge').addClass('badge-info');
                    }
                    else
                    {
                        $(".number-notifications-badge").text('');
                        $(".number-notifications-badge").removeClass('badge').removeClass('badge-info');
                    }
                    
                    if(number_new_notis > 0)
                    {
                        $(".number-notifications-badge").addClass('badge').addClass('badge-info').html(number_new_notis);
                    }
                    
                    last_update = response.last_update.date;
                    
                    var list = $("#list-notification");
                    list.empty();
                    addNotifications(notifications);
                }
            });
        }
        getNotifications();
        
        function addNotifications(notis)
        {
            $.each(notis,function(index,noti){
                  var stt =' ';
                  if(noti.is_read==0) stt='unread '; 
                        $("#list-notification").prepend(
                            '<li class="'
                            +stt
                             +noti.class_notification
                             +'">'
                              +'<a href="'+noti.link+'" target="_blank">'
                                  +'<i class="'+noti.class_icon+' pull-right">'
                                  +'</i>'
                                  +'<span class="line">'
                                     +'<strong>'
                                      + noti.description
                                      +'</strong>'
                                 +' </span>'
                                  +'<span class="line small">'
                                      +noti.period
                                  +'</span>'
                              +'</a>'
                          +'</li>'  
                          );
                    }); 
        }
        
        function updateNotifications()
        {
           $.get('<?php echo url('admin/notification/get-new'); ?>',{last_update:last_update},function(response,status){
               if(status=='success'){
                   if(response.new_notificatoins){
                        
                        last_update = response.last_update.date;
                        var new_notifications = response.new_notifications;
                        addNotifications(new_notifications);
                        $.each(new_notifications,function(index,noti){
                               setTimeout(toastr.info(noti.description),5000); 
                               
                        });
                        
                    }
               }
           });
        }
        
          
        $("#list-notification-btn").click(function(){
            
            $.post('<?php echo url('admin/notification/set-old'); ?>',{last_update:last_update},function(response,status){
                if(status=='success'){
                    number_new_notis = 0;
                    $('.number-notifications').html(number_new_notis);
                    $(".number-notifications-badge").html('');
                }
            });
        });
        
        $(".mark-all-read").click(function(e){
            e.preventDefault();
            e.stopPropagation();
            $("#list-notification li").each(function(index){
                $(this).removeClass('unread');
             });
            $.post('<?php echo url('admin/notification/mark-all-read'); ?>',{last_update:last_update},function(response,status){
                if(status=='success'){
                   
                }
            });
        });
    });
</script>