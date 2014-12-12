@extends('admin.layouts.default')

@section('content')

<table id='course-table' class="table datatable">
    <thead>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>start day</th>
            <th>end day</th>
            <th>Instructor</th>
            <th>Categories</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($courses as $course)
        <tr>
            <td>{{$course->id}}</td>
            <td>{{$course->name}}</td>
            <td>{{$course->start_day}}</td>
            <td>{{$course->end_day}}</td>
            <td>
                @foreach($course->instructors as $instructor)
                <div>{{$instructor['username']}}</div>
                @endforeach
            </td>
            <td>
                @foreach($course->categories as $category)
                <div>{{$category->name}}</div>
                @endforeach
            </td>
            <td>
                <a href="<?php echo url('admin/course/edit/'.$course->id) ?>" class="btn-link">
                    edit
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@if(count($courses_trashed))
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
                <a href="<?php echo url('admin/course/destroy/'.$course_trash->id) ?>"  class="btn-link">
                    Delete
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@stop


@section('scripts')

@stop