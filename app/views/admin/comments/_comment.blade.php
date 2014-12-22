@extends('admin.layouts.default')
@section('content')
<div class="panel-body no-padding">

    <!-- List of Comments -->					
    <ul class="comments-list">
        @foreach($comments as $comment)
        <!-- Comment Entry -->						
        <li>
            <div class="comment-checkbox">
                <div class="checkbox checkbox-replace neon-cb-replacement">
                    <label class="cb-wrapper"><input type="checkbox"><div class="checked"></div></label>
                </div>
            </div>

            <div class="comment-details">

                <div class="comment-head">
                    <a href="#"><?php echo User::find($comment->user_id)->username; ?></a> commented on <a href="#">
                        <?php echo Post::find($comment->commentable_id)->title; ?></a>
                </div>

                <p class="comment-text">
                    <?php echo $comment->content; ?>
                </p>

                <div class="comment-footer">

                    <div class="comment-time">
                        <?php echo $comment->created_at; ?>
                        
                    </div>

                    <div class="action-links">

                        <a href="#" class="warning">
                            <i class="entypo-alert"></i>
                            Mark as spam
                        </a>

                        <a href="#" class="delete">
                            <i class="entypo-cancel"></i>
                            Delete
                        </a>


                    </div>

                </div>

            </div>
        </li>

@endforeach

    </ul>

</div>


@stop
@section('scripts')
<script src="<?php echo asset('assets/backend/js/selectboxit/jquery.selectBoxIt.min.js');?>"></script>
@stop