@extends('layouts.index')
@section('content')

@if (session('flash_message'))
    <div class="card-body">
        <div class="alert alert-success">
            {{ session('flash_message') }}
        </div>
    </div>
@endif
{{--Auth::check() && Auth::id() == $author->id--}}
@if (Auth::check() && Auth::user()->role->first()->name == "Admin")
<div>
    {!! Form::open(['method' => 'delete', 'route' => ['examen.destroy', $examen->id]]) !!}
    <input type="submit" value="Eliminar examen" class="btn btn-danger" id= "examen_button">
    {!! Form::close() !!}
</div>
@endif
<div class="jumbotron">
    <div class="examen-title">
        <h1 class = "display-4">{{ $examen->titulo_examen }}</h1>
    </div>
   

@if (Auth::user()->role->first()->name == "Student")
    <div class="course-button">
        {{--<a href="{{ route('test.singletest', [$examen->id]) }}" type="button" class="btn btn-primary btn-lg">Presentar Examen</a>--}}
    <form action="{{ url('/test.singletest') }}" method="GET">
        @csrf
        <input type="hidden" name="examen_id" value="{{ $examen->id }}">
        <button type="submit">Presentar examen</button>
    </form>
        {{--<a href="{{ route('tests/test.singleexamen', [$examen->id]) }}" class="btn btn-secondary" id= "examen_button">Presentar examen</a>--}}
    </div>
@endif
</div>

<a href="{{ route('examen.index') }}" class="btn btn-secondary" id="home_button">Volver</a>
@endsection