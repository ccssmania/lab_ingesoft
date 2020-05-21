@extends('layouts.index')

@section('content')

<div class="container">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Logro</th>
                <th>Descripción</th>
                <th>Examen</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->name }}</td>
                    <td>{{ $log->description }}</td>
                    <td>{{ $log->exam ? $log->exam->titulo_examen : '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection