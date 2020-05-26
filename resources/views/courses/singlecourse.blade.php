@extends('layouts.index')
@section('content')

@if (session('flash_message'))
    <div class="card-body">
        <div class="alert alert-success">
            {{ session('flash_message') }}
        </div>
    </div>
@endif

@if (Auth::check() && Auth::id() == $author->id)
    <a href="{{ route('course.edit', [$course->id]) }}" class="btn btn-secondary" id= "course_button">Editar Curso</a>
    {!! Form::open(['method' => 'delete', 'route' => ['course.destroy', $course->id]]) !!}
    <input type="submit" value="Eliminar curso" class="btn btn-danger" id= "course_button">
    {!! Form::close() !!}
@endif
<div class="jumbotron">
    <div class="course-title">
        <h1 class = "display-4">{{ $course->title }}</h4>
    </div>
    <div class="course-author">
        <h6 class= "lead">Autor: {{ $author->name }}</h6>
    </div>

    @if ($enroll == true && Auth::user()->role->first()->name == "Student")
        <div class="course-author">
            <h5 class= "lead">Descripción: {{ $course->description }}</h5>
        </div>
        <div class="course-author">
            <h5 class= "lead">Lecciones:</h5>
        </div>
        <div class="container">
        @foreach($course->lessons as $lesson)
                <div class=" ml-5">
                    <h3 class="lead"><strong><a href="{{ url('/course/lessons/'.$lesson->id) }}">{{ $lesson->titulo }}</a></strong></h3>
                </div>
        @endforeach
        </div>
        <div class="course-button">
            <a href="{{ route('course.unenroll', [$course->id]) }}" type="button" class="btn btn-primary btn-lg">Darse de baja</a>
            {{-- @if ($complete == false)
                <br>
                <a href="{{ route('course.complete', [$course->id]) }}" type="button" class="btn btn-primary btn-lg" >Marcar como completo</a>
                <br>
            @endif --}}
        </div>
    @else
        @if ($complete == false)
            <a href="{{ route('course.enroll', [$course->id]) }}" type="button" class="btn btn-primary btn-lg" >Inscribirse</a>
        @endif
    @endif
</div>
@endsection