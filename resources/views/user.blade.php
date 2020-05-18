@extends('layouts.index')
@section('content')
@if (session('flash_message'))
    <div class="card-body">
        <div class="alert alert-success">
            {{ session('flash_message') }}
        </div>
    </div>
@endif
{{-- <a href="{{ route('course.create') }}">{!! Form::button('Add New Course', ['class' => 'btn btn-secondary', 'id' => 'course_button']) !!}</a> --}}
{{--<a href="{{ route('user.create') }}" class="btn btn-secondary" id="course_button">Add New User</a>--}}

<h1 class="my-4">Usuarios</h1>

<table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Email</th>
            <th scope="col">Rol</th>
            <th scope="col">Accion</th>
          </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->first()->name }}</td>
                    <td>
                        {!! Form::open(['method' =>"delete", 'action' => ['UserController@destroy', $user->id]]) !!}
                            <a class="btn btn-secondary" href = "{{route('user.edit', [$user->id])}}">Editar</a>
                            {{-- <a class="btn btn-danger" href = "{{ route('user.destroy', [$user->id]) }}"> --}}
                                <input class="btn btn-danger" type = "submit" value = "Eliminar">
                            {{-- </a> --}}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach

        </tbody>
      </table>
@endsection