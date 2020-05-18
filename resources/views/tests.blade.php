@extends('layouts.index')

@section('content')
@if (session('flash_message'))
    <div class="card-body">
        <div class="alert alert-success">
            {{ session('flash_message') }}
        </div>
    </div>
@endif
@if (Auth::check() && (Auth::user()->role->first()->name == 'Author' or Auth::user()->role->first()->name == "Admin"))
    <a href="{{ route('test.create') }}" class="btn btn-secondary" id="course_button">Crear un nuevo examen</a>
@endif
<div class="container" id = "coursescontent">
    <div class="row">
        <div class="col-md-12">
            @if ($tests->isEmpty())
                @if (session('test'))
                    <div class="card-body">
                        <h2 class="alert alert-info">
                            {{ session('test') }}
                        </h2>
                    </div>
                @endif
            @else
            <h1 class="my-4">Preguntas</h1>
            @foreach ($tests as $test)

            <div class="card mb-4">
                {{-- <img class="card-img-top" src="" alt="{{ $course['thumbnail'] }}"> --}}
                <a href = "{{ route('test.show', [$test->id]) }}"></a>
                <div class="card-body">
                    <h2 class="card-title"><a href = "{{ route('test.show', [$test->id]) }}">{{ $test['pregunta'] }}</a></h2>
                    <p class="card-text">{{ $test['tipo_pregunta'],$test['nivel']}}</p>
                </div>
          {{--      <div class="card-footer text-muted">
                    Author: {{ $test->author['name'] }}
                </div>
                --}}
            </div>

            @endforeach
            @endif
        </div>
    </div>
</div>


@endsection