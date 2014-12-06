<p>Are you sure you want to delete {{ $post->title }}?</p>
 
{{ Form::open(['route' => ['admin.post.destroy', $post->id], 'method' => 'delete']) }}
  <button type="submit">Delete</button>
{{ Form::close() }}
