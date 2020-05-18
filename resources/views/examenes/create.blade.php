@extends('layouts.index')
@section('content')
    <div class="container">
        {!! Form::open(['method' => 'POST', 'action' => 'ExamenController@store', 'id' => 'examen_create_form', 'files' => 'true']) !!}
        @include('examenes.form')
    </div>
@endsection