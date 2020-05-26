@extends('layouts.index')
@section('content')
	<div class="container">
		<div class="card">
			<div>{!! $lesson->contenido !!}</div>
		</div>
	</div>
@endsection