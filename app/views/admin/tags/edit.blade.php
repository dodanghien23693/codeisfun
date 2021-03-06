@extends('admin.layouts.default')

@section('content')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h1>Edit Tag</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                {{ implode('', $errors->all('<li class="error">:message</li>')) }}
            </ul>
        </div>
        @endif
    </div>
</div>

{{ Form::model($tag, array('class' => 'form-horizontal', 'method' => 'PATCH', 'route' => array('admin.tag.update', $tag->id))) }}

<div class="form-group">
    {{ Form::label('name', 'Name:', array('class'=>'col-md-2 control-label')) }}
    <div class="col-sm-10">
        {{ Form::text('name', Input::old('name'), array('class'=>'form-control', 'placeholder'=>'Name')) }}
    </div>
</div>




<div class="form-group">
    <label class="col-sm-2 control-label">&nbsp;</label>
    <div class="col-sm-10">
        {{ Form::submit('Update', array('class' => 'btn btn-lg btn-primary')) }}
        {{ link_to_route('admin.tag.show', 'Cancel', $tag->id, array('class' => 'btn btn-lg btn-default')) }}
    </div>
</div>

{{ Form::close() }}

@stop