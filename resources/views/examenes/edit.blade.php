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
        {!! Form::model($examen, ['method' => 'PATCH', 'files' => 'true', 'action' => ['ExamenController@update',  $examen->id], 'id' => 'examen_create_form']) !!}
        @include('examenes.form')
</div>
@endsection