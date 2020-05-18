@extends('layouts.index')
@section('content')
    @if (session('flash_message'))
        <div class="card-body">
            <div class="alert alert-success">
                {{ session('flash_message') }}
            </div>
        </div>
    @endif
<div class="container">
        {!! Form::model($test, ['method' => 'PATCH', 'files' => 'true', 'action' => ['TestController@update',  $test->id], 'id' => 'test_create_form']) !!}
        @include('tests.form')
</div>
@endsection