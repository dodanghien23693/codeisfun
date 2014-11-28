
@if (Session::has('error'))
  {{ trans(Session::get('reason')) }}
@endif
 
{{ Form::open(array('route' => 'password.request')) }}
 
  <p>{{ Form::label('email', 'Email') }}
  {{ Form::text('email') }}</p>
 
  <p>{{ Form::submit('Submit') }}</p>
 
{{ Form::close() }}