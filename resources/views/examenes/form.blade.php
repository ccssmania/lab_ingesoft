<div class="form-group">
    {!! Form::label('titulo_examen', 'Nombre del Examen:') !!}
    {!! Form::text('titulo_examen', null, ['class' => 'form-control']) !!}
</div>
{{-- <div class="form-group">
    {!! Form::label('thumbnail', 'Course Thumbnail:' ) !!}
    {!! Form::file('thumbnail', array('class' => 'form-control', 'accept'=> 'image/*')) !!}
    @if (isset($course))
        {!! Html::image('/storage/'.$course->thumbnail, 'Thumbnail') !!}
    @endif
</div> --}}
<div class="form-group">
    <select name="course" id="course">
        @foreach ($courses as $course)
            <option value="{{$course->id}}">{{$course->title}}</option>
        @endforeach
    </select>
    {{--{{ Form::select('course', array('{{$courses->id}}'=>'{{$courses->title}}') }}--}}
</div>
<div class="form-group">
    {!! Form::label('cantidad', 'cantidad de preguntas: ') !!}
    {!! Form::number('cantidad', null, array('class' => 'form-control')) !!}
</div>
{!! Form::submit($submitbuttontext, ['class' => 'btn']) !!}
{!! Form::close() !!}
<a href="{{ route('examen.index') }}" class="btn btn-secondary" id="home_button">Cancelar</a>
