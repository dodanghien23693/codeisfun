@extends('admin.layouts.default')

@section('content')

<h1>Show Tag</h1>

<p>{{ link_to_route('tag.index', 'Return to All tags', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
				<th>Slug</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $tag->name }}}</td>
				
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('tag.destroy', $tag->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('tag.edit', 'Edit', array($tag->id), array('class' => 'btn btn-info')) }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
