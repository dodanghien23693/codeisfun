@extends('admin.layouts.default')

@section('content')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h1>Create Tag</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                {{ implode('', $errors->all('<li class="error">:message</li>')) }}
            </ul>
        </div>
        @endif
    </div>
</div>

{{ Form::open(array('route' => 'admin.tag.store', 'class' => 'form-horizontal')) }}

<div class="form-group">
    {{ Form::label('name', 'Name:', array('class'=>'col-md-2 control-label')) }}
    <div class="col-sm-10">
        {{ Form::text('name', Input::old('name'), array('class'=>'form-control', 'placeholder'=>'Name')) }}
    </div>
</div>


<div class="form-group">
    <label class="col-sm-2 control-label">&nbsp;</label>
    <div class="col-sm-10">
        {{ Form::submit('Create', array('class' => 'btn btn-lg btn-primary')) }}
    </div>
</div>

{{ Form::close() }}

@stop


