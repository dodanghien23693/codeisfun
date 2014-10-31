
@extends('public.layouts.default')

@section('content')
        {{ Form::open(array('action'=>'AuthController@login')); }}
        

            {{ Form::label('username','Email or Username'); }}
            {{ Form::input('text', 'username', '', array()); }}
            <hr>
            {{ Form::label('password','Password'); }} 
            {{ Form::password('password', array()); }}
            <hr>
            Don't have an account? {{ link_to_route('register','Create a free account') }}
            <hr>
            {{ Form::submit('Sign in', array()); }}
            
            <hr>
            
            
            
        {{ Form::close(); }}

        Login with: {{ link_to_route('facebook','Facebook') }} '  '
        {{ link_to_route('google','Google') }}
            
@stop