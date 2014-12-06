
<?php echo Form::model($chapter, array('class'=>'form-horizontal edit-chapter-form-modal','role'=>'form'));?>
    <input type="hidden" name='id' value='{{$chapter->id}}'>
    <input type="text" name="name" value="{{$chapter->name}}" class="form-control">
    
<?php echo Form::close(); ?>

