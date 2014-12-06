@extends('admin.layouts.default')

@section('content')


<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h1>Edit User</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::model($user, array('class' => 'form-horizontal', 'method' => 'PATCH', 'route' => array('admin.user.update', $user->id))) }}

         <div class="form-group">
            {{ Form::label('username', 'Username:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('username', Input::old('username'), array('class'=>'form-control', 'placeholder'=>'User name')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('first_name', 'Firstname:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('first_name', Input::old('first_name'), array('class'=>'form-control', 'placeholder'=>'First name')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('last_name', 'Lastname:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('last_name', Input::old('last_name'), array('class'=>'form-control', 'placeholder'=>'Last name')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('email', 'Email:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('email', Input::old('email'), array('class'=>'form-control', 'placeholder'=>'Email')) }}
            </div>
        </div>
         <div class="form-group">
            {{ Form::label('gender', 'Gender:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{Form::select('gender',array('male'=>'Male','female'=>'Female'),null,array('class'=>'form-control'))}}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('password', 'Password:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('role_id', 'Role:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
             
             {{Form::select('role_id',Role::lists('name','id'),null,array('class'=>'form-control'))}}
            </div>
        </div>

<div class="form-group">
    <label class="col-sm-2 control-label">&nbsp;</label>
    <div class="col-sm-10">
      {{ Form::submit('Update', array('class' => 'btn btn-lg btn-primary')) }}
      {{ link_to_route('admin.user.show', 'Cancel', $user->id, array('class' => 'btn btn-lg btn-default')) }}
    </div>
</div>

{{ Form::close() }}

@stop