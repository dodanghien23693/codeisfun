@extends('admin.layouts.default')

@section('content')

<h1>All Posts</h1>

<p>{{ link_to_route('admin.post.create', 'Add New Post', null, array('class' => 'btn btn-lg btn-success')) }}</p>

@if ($posts->count())
	<table class="table table-striped">
		<thead>
			<tr>
			<th>ID</th>
				
				<th>Title</th>
				<th>Cover Image</th>
				<th></th>
		</tr>
		</thead>

		<tbody>
			@foreach ($posts as $post)
				<tr>
				<td>{{{ $post->id }}}</td> 
					<td>{{ link_to_route('admin.post.show', $post->title, array($post->id), array('class' => '')) }}</td>
					<td><img src="{{asset($post->cover_image_url)}}" style="max-width:200px;max-height:200px;"></td>
					
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('admin.post.destroy', $post->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger', 'id' => 'delete')) }}
                        {{ Form::close() }}
                        {{ link_to_route('admin.post.edit', 'Edit', array($post->id), array('class' => 'btn btn-info')) }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
   <script type="text/javascript" src="{{asset('')}}/jquery-1.11.1.min.js">
</script>
<script type= "text/javascript">
$(document).ready(function(){
	$("#delete").click(function(){
		if(!confirm("Delete or not?")){
				return false;
		};
		})
	});
</script>
@else
	There are no posts
@endif

@stop
