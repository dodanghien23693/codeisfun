
<?php echo Form::open(array('action'=> 'FileController@upload', 'files'=> true, 'method'=>'post')) ?>

    <input type="file" name="coverimage" >

    <input type="submit" value="upload">
{{ Form::close(); }}
