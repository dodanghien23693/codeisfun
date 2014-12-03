@extends('admin.layouts.default')

@section('content')

<h1>Show Post</h1>

<p>{{ link_to_route('posts.index', 'Return to All posts', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>User_id</th>
				<th>Slug</th>
				<th>Title</th>
				<th>Cover_image</th>
				<th>Description</th>
				<th>Content</th>
				<th>Status_id</th>
				<th>Visibility_id</th>
				<th>Public_time</th>
				<th>Modified_date</th>
				<th>View_count</th>
				<th>Comment_count</th>
				<th>Comment_status</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $post->user_id }}}</td>
					<td>{{{ $post->slug }}}</td>
					<td>{{{ $post->title }}}</td>
					<td>{{{ $post->cover_image }}}</td>
					<td>{{{ $post->description }}}</td>
					<td>{{{ $post->content }}}</td>
					<td>{{{ $post->status_id }}}</td>
					<td>{{{ $post->visibility_id }}}</td>
					<td>{{{ $post->public_time }}}</td>
					<td>{{{ $post->modified_date }}}</td>
					<td>{{{ $post->view_count }}}</td>
					<td>{{{ $post->comment_count }}}</td>
					<td>{{{ $post->comment_status }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('posts.destroy', $post->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger', 'id' => 'delete')) }}
                        {{ Form::close() }}
                        {{ link_to_route('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-info')) }}
                    </td>
		</tr>
	</tbody>
</table>
<script type="text/javascript" src="{{public_path()}}/1jquery-1.11.1.min.js">
</script>
<script type= "text/javascript">
$(document).ready(function){
	alert("aafsafasf");
	if($("#delete").confirm("Có muốn xóa không?");){
		alert("aafsafasf");
		}
	}
</script>
@stop
