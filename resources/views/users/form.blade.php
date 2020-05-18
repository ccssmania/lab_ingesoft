<div class="form-group">
    {!! Form::label('name', 'Nombre: ') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('email', 'Correo: ') !!}
    {!! Form::text('email',null, ['class' => 'form-control','readonly']) !!}
</div>
{{-- @guest --}}
<div class="form-group">
    <label for="role" class="col-form-label">Seleccione Rol:</label>
    @if (Auth::check() && Auth::user()->role()->first()->name == "Admin" )
        <select name="role" class="form-control" id="selectrole">
            <option value = "1">Administrador</option>
            <option value = "3">Estudiante</option>
        </select>
    @else
    <select name="role" class="form-control" id="selectrole">
        <option value = "3">Estudiante</option>
    </select>
    @endif
</div>
{{-- @endguest --}}
<div class="form-group">
        {!! Form::label('password', 'Contraseña: ') !!}
        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => "Nueva Contraseña"]) !!}
</div>
{!! Form::submit($submitbuttontext, ['class' => 'btn']) !!}
{!! Form::close() !!}
<td>
    {!! Form::open(['method' =>"delete", 'action' => ['UserController@destroy', $user->id]]) !!}
        {{--<a class="btn btn-secondary" href = "{{route('user.edit', [$user->id])}}">Edit</a>--}}
        {{-- <a class="btn btn-danger" href = "{{ route('user.destroy', [$user->id]) }}"> --}}
            <input class="btn btn-danger" type = "submit" value = "Delete">
        {{-- </a> --}}
    {!! Form::close() !!}
</td>

