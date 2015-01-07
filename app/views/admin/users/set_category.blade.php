@extends('admin.layouts.default')

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h1>Set Writers and Managers Category</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>
<?php

    $writers =Role::where('name','Writer')->first()->user()->get();
    $managers=Role::where('name','Manager')->first()->user()->get();
    $list_rows = $writers->merge($managers);
    $list=array();
    foreach($list_rows as $row)
{
    $list[$row->id]=$row->username.' --- '.$row->role->name; 
}

?>
{{Form::open(array('class'=>'form-horizontal','url'=>URL::action('UserController@postSetCategory')))}}
  <div class="form-group">
            {{ Form::label('user_id', 'User_name:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::select('user_id',$list ,null,array('class'=>'form-control') ) }}
            </div>
        </div>
 <div class="form-group">
            {{ Form::label('post_category[]', 'Category:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">

              {{Form::select('post_category[]', Category::lists('name','id'), null, array('multiple','class'=>'form-control'));}}
            </div>
        </div>
<div class="form-group">
<div class="col-sm-10 col-sm-offset-2">
    <input type="submit" value="Save" class="btn btn-danger">
</div>
</div>
{{Form::close()}}
<script>
function getUC()
{
    user_id = $('#user_id').val();
selectbox = $('#post_category\\[\\]');
$.get("{{URL::action('UserController@getUserCategories')}}",
"user_id="+user_id,
function(data)
{
    if(data){
selectbox.val(data);
}
} 
    );
}

$('#user_id').change(getUC);
$(document).ready(getUC);
</script>
@stop
