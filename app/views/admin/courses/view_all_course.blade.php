@extends('admin.layouts.default')

@section('content')

<table id='course-table' class="table datatable">
    <thead>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>short name</th>
            <th>start day</th>
            <th>end day</th>
            <th>cost</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($courses as $course)
        <tr>
            <td>{{$course->id}}</td>
            <td>{{$course->name}}</td>
            <td>{{$course->short_name}}</td>
            <td>{{$course->start_day}}</td>
            <td>{{$course->end_day}}</td>
            <td>{{$course->cost}}</td>
            <td>
                <a href="<?php echo url('admin/course/edit/'.$course->id) ?>" class="btn-link">
                    edit
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


<table id='course-trashed-table' class="table datatable">
    <thead>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>short name</th>
            <th>start day</th>
            <th>end day</th>
            <th>cost</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($courses_trashed as $course_trash)
        <tr>
            <td>{{$course_trash->id}}</td>
            <td>{{$course_trash->name}}</td>
            <td>{{$course_trash->short_name}}</td>
            <td>{{$course_trash->start_day}}</td>
            <td>{{$course_trash->end_day}}</td>
            <td>{{$course_trash->cost}}</td>
            <td>
                <a href="<?php echo url('admin/course/restore/'.$course_trash->id) ?>" class="btn-link">
                    Restore
                </a>
                |
                <a href="<?php echo url('admin/course/destroy/'.$course_trash->id) ?>" class="btn-link">
                    Delete
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@stop


@section('scripts')

<script src="<?php echo asset('assets/backend/js/datatables/jquery.dataTables.columnFilter.js'); ?>"></script>
<script src="<?php echo asset('assets/backend/js/datatables/responsive/js/datatables.responsive.js'); ?>"></script>

<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		var table = $("#course-table").dataTable().makeEditable();
		
		
	});
        
        

	

</script>
@stop