@if (Session::has('message'))
  <div>{{ Session::get('message') }}</div>
@endif
 
<div>
  <a href="{{ URL::route('post.create') }}">Create</a>
</div>
 
<table>
  <thead>
    <tr>
      <th>Name</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($posts as $posts)
      <tr>
        <td> {{ $post->title }} </td>
        <td> {{$post->description}} </td>
        <td><a href="{{ URL::route('post.show', ['id' => $post->id]) }}">Read more</a></td>
      </tr>
    @endforeach
  </tbody>
</table>