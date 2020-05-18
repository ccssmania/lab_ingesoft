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
    <a href="{{ route('examen.create') }}" class="btn btn-secondary" id="examen_button">Crear titulo del nuevo examen</a>
@endif
<div class="container" id = "coursescontent">
    <div class="row">
        <div class="col-md-12">
            @if ($examenes->isEmpty())
                @if (session('examen'))
                    <div class="card-body">
                        <h2 class="alert alert-info">
                            {{ session('examen') }}
                        </h2>
                    </div>
                @endif
            @else
            <h1 class="my-4">Examen</h1>
            @foreach ($examenes as $examen)

            <div class="card mb-4">
                {{-- <img class="card-img-top" src="" alt="{{ $course['thumbnail'] }}"> --}}
                <a href = "{{ route('examen.show', [$examen->id]) }}" ></a>
                <div class="card-body">
                    <h2 class="card-title"><a href = "{{ route('examen.show', [$examen->id]) }}">{{ $examen['titulo_examen'] }}</a></h2>
                    {{--<p class="card-text">{{ $examen[''],$test['nivel']}}</p>--}}
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

@if (Auth::check() && (Auth::user()->role->first()->name == 'Author' or Auth::user()->role->first()->name == "Admin") && (!($examenes->isEmpty())))
    <a href="{{ route('test.create') }}" class="btn btn-secondary" id="examen_button">Crear preguntas del nuevo examen</a>
@endif

@endsection