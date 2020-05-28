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
    <a href="{{ route('course.create') }}" class="btn btn-secondary" id="course_button">Crear un Nivel nuevo</a>
@endif
<progress-bar :progress="{{ $progress }}"></progress-bar>
<div class="container" id = "coursescontent">
    <div class="row">
        <div class="col-md-12">
            @if (count($courses) == 0)
                @if (session('course'))
                    <div class="card-body">
                        <h2 class="alert alert-info">
                            {{ session('course') }}
                        </h2>
                    </div>
                @endif
            @else
            <h1 class="my-4">Niveles Disponibles</h1>
            @foreach ($courses as $course)

                <div class="card mb-4">
                    {{-- <img class="card-img-top" src="" alt="{{ $course['thumbnail'] }}"> --}}
                    <a href="{{ url('/course/' . $course->id) }}"></a>
                    <div class="card-body">
                        <h2 class="card-title"><a href = "{{ url('/course/' . $course->id) }}">{{ $course->title }}</a></h2>
                        {{-- <p class="card-text">{{ $course['description'] }}</p> --}}
                    </div>
                    {{--<div class="card-footer text-muted">
                        Author: {{ $course->author['name'] }} 
                    </div>--}}
                    @if(App\UserCourse::where('user_id', \Auth::user()->id)->where('course_id', $course->id)->first() !== null and App\UserCourse::where('user_id', \Auth::user()->id)->where('course_id', $course->id)->first()->course_completed == 1)
                        <div class="check">
                            <i class="fa fa-check-circle fa-2x"></i>
                        </div>
                    @endif
                </div>

            @endforeach
            @endif
        </div>
    </div>
</div>


@endsection