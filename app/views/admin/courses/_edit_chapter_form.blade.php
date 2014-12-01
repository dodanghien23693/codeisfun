
<?php echo Form::model($chapter, array('class'=>'form-horizontal','role'=>'form'));?>

<input type="text" name="name" value="{{$chapter->name}}" class="form-control">
<input type="submit" value="update" class="form-control">
<?php echo Form::close(); ?>