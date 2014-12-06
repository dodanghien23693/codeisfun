@extends('admin.layouts.default')

@section('content')


<p style ="padding-top : 10px">{{ link_to_route('admin.post.index', 'Return to All posts', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<h1>{{$post->title}}</h1>

<div class='content'>
	{{$post->content}}
	</div>
@stop