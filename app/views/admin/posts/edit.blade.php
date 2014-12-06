@extends('admin.layouts.default')

@section('content')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h1>Edit Post</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                {{ implode('', $errors->all('<li class="error">:message</li>')) }}
            </ul>
        </div>
        @endif
    </div>
</div>

{{ Form::model($post, array('class' => 'form-horizontal', 'method' => 'PATCH', 'route' => array('admin.post.update', $post->id),'files'=>'true'))}}
<div class="form-group">
    {{ Form::label('user_id', 'User_name:', array('class'=>'col-md-2 control-label')) }}
    <div class="col-sm-10">
        {{ Form::select('user_id', User::lists('username','id'),null,array('class'=>'form-control') ) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('slug', 'Slug:', array('class'=>'col-md-2 control-label')) }}
    <div class="col-sm-10">
        {{ Form::text('slug', Input::old('slug'), array('class'=>'form-control', 'placeholder'=>'Slug')) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('title', 'Title:', array('class'=>'col-md-2 control-label')) }}
    <div class="col-sm-10">
        {{ Form::text('title', Input::old('title'), array('class'=>'form-control', 'placeholder'=>'Title')) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('cover_image_file', 'Cover_image:', array('class'=>'col-md-2 control-label')) }}
    <div class="col-sm-10">
        {{ Form::file('cover_image_file',array('class'=>'form-control')) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('description', 'Description:', array('class'=>'col-md-2 control-label')) }}
    <div class="col-sm-10">
        {{ Form::text('description', Input::old('description'), array('class'=>'form-control', 'placeholder'=>'Description')) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('content', 'Content:', array('class'=>'col-md-2 control-label')) }}
    <div class="col-sm-10">
        {{ Form::textarea('content', Input::old('content'), array('class'=>'ckeditor')) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('Post_status_id', 'Status_id:', array('class'=>'col-md-2 control-label')) }}
    <div class="col-sm-10">
        {{ Form::select('post_status_id', PostStatus::lists('name','id'),null,array('class'=>'form-control') ) }}
    </div>
</div>



<div class="form-group">
    {{ Form::label('public_time', 'Public_time:', array('class'=>'col-md-2 control-label')) }}
    <div class="col-sm-10">
        <input type="date" class="form-control" placeholder="Public_time" name="public_time" id="public_time" value={{$post->public_time}}>
    </div>
</div>

<!--<div class="form-group">
    {{ Form::label('modified_date', 'Modified_date:', array('class'=>'col-md-2 control-label')) }}
    <div class="col-sm-10">
        <input type="date" class="form-control" placeholder="Modified_date" name="modified_date" id="modified_date" value={{$post->modified_date}}>
    </div>
</div>
-->
<div class="form-group">
    {{ Form::label('view_count', 'View_count:', array('class'=>'col-md-2 control-label')) }}
    <div class="col-sm-10">
        {{ Form::text('view_count', Input::old('view_count'), array('class'=>'form-control', 'placeholder'=>'View_count')) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('comment_count', 'Comment_count:', array('class'=>'col-md-2 control-label')) }}
    <div class="col-sm-10">
        {{ Form::text('comment_count', Input::old('comment_count'), array('class'=>'form-control', 'placeholder'=>'Comment_count')) }}
    </div>
</div>

<!-- <div class="form-group">
     {{ Form::label('comment_status', 'Comment_status:', array('class'=>'col-md-2 control-label')) }}
     <div class="col-sm-10">
       {{ Form::text('comment_status', Input::old('comment_status'), array('class'=>'form-control', 'placeholder'=>'Comment_status')) }}
     </div>
 </div>
-->
<div class="form-group">
            {{ Form::label('post_category[]', 'Category:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">

              {{Form::select('post_category[]', Category::lists('name','id'),Post::find($post->id)->categories->lists('id') , array('multiple','class'=>'form-control'));}}
            </div>
        </div>
    <div class="form-group">
        {{ Form::label('post_tag[]', 'Tag:', array('class'=>'col-md-2 control-label')) }}
        <div class="col-sm-10">
              {{Form::select('post_tag[]', Tag::lists('name','id'),Post::find($post->id)->tags->lists('id') , array('multiple','class'=>'form-control'));}}
        </div>
    </div>


<div class="form-group">
    <label class="col-sm-2 control-label">&nbsp;</label>
    <div class="col-sm-10">
        {{ Form::submit('Update', array('class' => 'btn btn-lg btn-primary')) }}
        {{ link_to_route('admin.post.show', 'Cancel', $post->id, array('class' => 'btn btn-lg btn-default')) }}
    </div>
</div>
<script type="text/javascript" src="{{asset('')}}/ckeditor/sample.js"></script>
<script type="text/javascript" src="{{asset('')}}/ckeditor/ckeditor.js"></script>
{{ Form::close() }}

@stop