@extends('layouts.index')
@section('content')
    <div class="container">
        {!! Form::open(['method' => 'POST', 'action' => 'TestController@store', 'id' => 'test_create_form', 'files' => 'true']) !!}
        @include('tests.form')
    </div>
@endsection