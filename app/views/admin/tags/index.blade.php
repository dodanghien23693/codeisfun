@extends('admin.layouts.default')

@section('content')

<h1>All Tags</h1>

<p>{{ link_to_route('admin.tag.create', 'Add New Tag', null, array('class' => 'btn btn-lg btn-success')) }}</p>

@if ($tags->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Name</th>
				
			</tr>
		</thead>

		<tbody>
			@foreach ($tags as $tag)
				<tr>
					<td>{{{ $tag->name }}}</td>
				
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('admin.tag.destroy', $tag->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('admin.tag.edit', 'Edit', array($tag->id), array('class' => 'btn btn-info')) }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no tag
@endif

@stop
