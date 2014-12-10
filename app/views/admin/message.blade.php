@extends('admin.layouts.default')

@section('content')
<div class="page-error-404">
	
	
	<div class="error-symbol">
		<i class="entypo-attention"></i>
	</div>
	
	<div class="error-text">
		<h2>CodeIsFun</h2>
                <p><h3>{{ $message }}</h3></p>
	</div>
	
	<hr>
	
	
</div>
@stop
