

@extends('public.layouts.default')

@section('content')


<div id="successMessage"> </div>
 
 
 @if (isset($errorMessage)) 
 {{ $errorMessage }}   
 @endif

 <div class="register">
  @if(isset($user))   
     {{ Form::model($user,array('id'=>'register_form','action'=>'AuthController@register')); }}
     @else
     {{ Form::open(array('id'=>'register_form','action'=>'AuthController@register')); }}
  @endif
            

            {{ Form::label('first_name','First name',array('class'=>'control-label')); }}
            {{ Form::text('first_name'); }}
             <div id ="first_name_error"></div>
           
             {{ Form::label('last_name','Last name',array('class'=>'control-label')); }}
            {{ Form::text('last_name'); }}
             <div id ="last_name_error"></div>
            <hr>
           
            {{ Form::label('username','User Name',array('class'=>'control-label')); }}
            {{ Form::text('username'); }}
             <div id ="username_error"></div>
            <hr>
          
            {{ Form::label('email','Your Email',array('class'=>'control-label')); }} 
            {{ Form::email('email'); }}
             <div id ="email_error"></div>
            <hr>
            
            {{ Form::label('password','Password',array('class'=>'control-label')); }} 
            {{ Form::password('password'); }}
             <div id ="password_error"></div>
            <hr>
            {{ Form::label('password_confirmation','Password confirm',array('class'=>'control-label')); }} 
            {{ Form::password('password_confirmation'); }}
            <hr>
            {{ Form::submit('Register'); }}
            
            <hr>
            
            
            
        {{ Form::close(); }}

        Already have an account? {{ link_to_route('login','Login') }}
 </div>
 
@stop

@section('scripts')
<script type="text/javascript">
    $.noConflict();
    jQuery( document ).ready(function($){
        $( "#register_form" ).submit(function( event ) {    
  event.preventDefault();
$('div[id $= "_error"]').each(function(){
    $(this).html('');
});
  var $form = $( this ),
    data = $form.serialize(),
    url = $form.attr( "action" );

var posting = $.post( url, { formData: data } );

  posting.done(function( data ) {
    if(data.fail) {
      $.each(data.errors, function( index, value ) {
        var errorDiv = '#'+index+'_error';
        $(errorDiv).addClass('required');
        $(errorDiv).empty().append(value);
      });
      $('#successMessage').empty();     
    } 
    if(data.success) {
        $('.register').fadeOut(); //hiding Reg form
        
       $('#successMessage').html(data.message);
    } //success
  }); //done
});
        
    });
    
</script>
@stop