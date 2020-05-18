@extends('layouts.index')
@section('content')

@if (session('flash_message'))
    <div class="card-body">
        <div class="alert alert-success">
            {{ session('flash_message') }}
        </div>
    </div>
@endif
{{-- Auth::check() && Auth::id() == $author->id
@if (Auth::check() && Auth::id() == $author->id)
    <a href="{{ route('test.edit', [$test->id]) }}" class="btn btn-secondary" id= "test_button">Editar Pregunta</a>
    {!! Form::open(['method' => 'delete', 'route' => ['test.destroy', $test->id]]) !!}
    <input type="submit" value="Eliminar pregunta" class="btn btn-danger" id= "test_button">
    {!! Form::close() !!}
@endif --}}
<div class="jumbotron">
    @foreach ($preguntas as $pregunta)
        <div id="pregunta_{{$pregunta->id_pregunta}}">
            <label>{{ $pregunta->pregunta }}</label><br>
            <input type="radio" name="respuesta_pregunta_{{ $pregunta->id_pregunta }}" id='answer_1' value="{{ $pregunta->respuesta_1 }}">
            <label>{{ $pregunta->respuesta_1 }}</label><br>
            <input type="radio" name="respuesta_pregunta_{{ $pregunta->id_pregunta }}" id='answer_2' value="{{ $pregunta->respuesta_2 }}">
            <label>{{ $pregunta->respuesta_2 }}</label><br>
            <input type="radio" name="respuesta_pregunta_{{ $pregunta->id_pregunta }}" id='answer_3' value="{{ $pregunta->respuesta_3 }}">
            <label>{{ $pregunta->respuesta_3 }}</label><br>
            <input type="radio" name="respuesta_pregunta_{{ $pregunta->id_pregunta }}" id='answer_4' value="{{ $pregunta->respuesta_4 }}">
            <label>{{ $pregunta->respuesta_4 }}</label><br>

            <input type="hidden" name="respuesta_seleccionada_1" value="0">
            
        </div>

    @endforeach
    {{--<div id="pregunta_1">
        <label><input type="radio" id='answer_1'>{{ $test->respuesta_1 }}</label>
        <label><input type="radio" id='answer_2'>{{ $test->respuesta_2 }}</label>
        <label><input type="radio" id='answer_3'>{{ $test->respuesta_3 }}</label>
        <label><input type="radio" id='answer_4'>{{ $test->respuesta_4 }}</label>

        <input type="hidden" name="respuesta_seleccionada_1" value="0">
    </div>--}}

    {{--<div class="test-title">
        <h1 class = "display-6">{{ $test->nivel }}</h4>
    </div>
    <div class="test-title">
        <h1 class = "display-6">{{ $test->tipo_pregunta }}</h4>
    </div>--}}

   {{-- @if ($enroll == true && Auth::user()->role->first()->name == "Student")
        <div class="course-content">
            <p class = "lead">{{ $course->description }}</p>
        </div>
        <div class="course-button">
            <a href="{{ route('course.unenroll', [$course->id]) }}" type="button" class="btn btn-primary btn-lg">Unenroll</a>
            @if ($complete == false)
                <br></br>
                <a href="{{ route('course.complete', [$course->id]) }}" type="button" class="btn btn-primary btn-lg" >Marcar como completo</a>
                <br></br>
            @endif
        </div>
    @else
        @if ($complete == false)
            <a href="{{ route('course.enroll', [$course->id]) }}" type="button" class="btn btn-primary btn-lg" >Enroll</a>
        @endif
    @endif--}}
</div>
<a href="{{ route('test.index') }}" class="btn btn-secondary" id="home_button">Volver</a>
@endsection
<script>

</script>