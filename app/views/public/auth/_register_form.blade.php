
@extends('public.layouts.default')

@section('content')
        {{ Form::open(array('action'=>'AuthController@register')); }}
        

            {{ Form::label('username','User Name'); }}
            {{ Form::input('text', 'username', '', array()); }}

            <hr>
            {{ Form::label('email','Your Email'); }} 
            {{ Form::email('email', '', array()); }}
            <hr>
            {{ Form::label('password','Password'); }} 
            {{ Form::password('password', array()); }}
            <hr>
            {{ Form::submit('Register', array()); }}
            
            <hr>
            
            
            
        {{ Form::close(); }}

        Already have an account? {{ link_to_route('login','Login') }}
            
@stop