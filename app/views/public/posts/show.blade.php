@if (Session::has('message'))
  <div>{{ Session::get('message') }}</div>
@endif
 
<table>
  <tr>
    <th>Name</th>
    <td>{{ $post->title}}</td>
    <td>{{ $post->description }}</td>
    
  </tr>
</table>