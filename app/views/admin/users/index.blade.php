@extends('admin.layouts.default')

@section('content')


<h1>List Users</h1>
<form id="custom-search-form" class="form-search form-horizontal pull-right" action="{{URL::action('UserController@search')}}" method="get">
    <div class="input-append spancustom">
        <input type="text" class="search-query" name="character" placeholder="Search">
        <button type="submit" class="btn btn-success">Search<i class="icon-search"></i></button>
    </div>
</form>

<p>{{ link_to_route('admin.user.create', 'Add New User', null, array('class' => 'btn btn-lg btn-success')) }}</p>

@if ($users->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Username</th>
				<th>Email</th>
				<th>Role</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($users as $user)
				<tr>
					<td>{{{ $user->username }}}</td>
					<td>{{{ $user->email }}}</td>
					<td>{{{ $user->role->name }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('admin.user.destroy', $user->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('admin.user.edit', 'Edit', array($user->id), array('class' => 'btn btn-info')) }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no users
@endif

@stop
