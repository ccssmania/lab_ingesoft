<div class="form-group">
    {!! Form::label('title', 'Titulo del curso:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>
{{-- <div class="form-group">
    {!! Form::label('thumbnail', 'Course Thumbnail:' ) !!}
    {!! Form::file('thumbnail', array('class' => 'form-control', 'accept'=> 'image/*')) !!}
    @if (isset($course))
        {!! Html::image('/storage/'.$course->thumbnail, 'Thumbnail') !!}
    @endif
</div> --}}
<div class="form-group">
    {!! Form::label('description', 'Contenido del nivel: ') !!}
    {!! Form::textarea('description', null, array('class' => 'form-control')) !!}
</div>

<div class="form-group">
    {!! Form::label('url', 'Contenido Complementario: ') !!}
    {!! Form::text('url', null, array('class' => 'form-control')) !!}
</div>

<add-box :new_="new_"></add-box>
<div class="row mt-5 mb-5">
    <div class="col-md-3">
        <h5>Agregar Lección </h5>
    </div>
    <form-box
        v-on:add_="add_"
    ></form-box>
</div>
{!! Form::submit($submitbuttontext, ['class' => 'btn']) !!}
{!! Form::close() !!}

<a href="{{ route('course.index') }}" class="btn btn-secondary" id="home_button">Cancelar</a>
