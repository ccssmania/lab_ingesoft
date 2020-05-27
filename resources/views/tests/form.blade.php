{{-- <div class="form-group">
    {!! Form::label('thumbnail', 'Course Thumbnail:' ) !!}
    {!! Form::file('thumbnail', array('class' => 'form-control', 'accept'=> 'image/*')) !!}
    @if (isset($course))
        {!! Html::image('/storage/'.$course->thumbnail, 'Thumbnail') !!}
    @endif
</div> --}}
<div class="form-group">
    
    <select name="cantidad" class="form-control" id="cantidad" onchange="cambio_cantidad()">
         <option value="0">Elija un examen</option>
        @foreach ($examenes as $examen)
            <option value="{{$examen->cantidad}}" data-id="{{ $examen->id }}">{{$examen->titulo_examen}}</option>
        @endforeach
    </select>
</div>

<div id="preguntas"></div>

<input type="hidden" name="id_examen" id="id_examen" value="">

<div id="boton_crear">

</div>
{{-- @if(!($variable == 'Elija un examen'))
{!! Form::submit($submitbuttontext, ['class' => 'btn']) !!}
{!! Form::close() !!}
@endif --}}
  

<a href="{{ route('test.index') }}" class="btn btn-secondary" id="home_button">Cancelar</a>

<script>

    function cambio_cantidad(){
        cantidad = document.getElementById('cantidad').value * 1;
        $('#id_examen').val($('#cantidad option:selected').data('id'));
        document.getElementById("boton_crear").innerHTML = "";
        if (cantidad != 0) {
            document.getElementById("boton_crear").innerHTML = '{!! Form::submit($submitbuttontext, ['class' => 'btn']) !!}' +
                                                               '{!! Form::close() !!}';
        }
        //alert(cantidad);
        document.getElementById('preguntas').innerHTML = "";
        
        parada = cantidad + 1;

        for (indice = 1; indice < parada; indice++) {
            //alert(indice);
            //actual_plantilla = document.getElementById('preguntas');
            //alert(actual_plantilla);
            texto_pregunta = "pregunta_" + indice;
            plantilla_a_agregar = '<div id="plantilla_pregunta_' + indice + '">'+
                                    '<div class="form-group">'+
                                        '{!! Form::label("' + texto_pregunta + '", "Pregunta:") !!}'+
                                        '<input class="form-control" name="' + texto_pregunta + '" type="text" id="' + texto_pregunta + '">'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '{!! Form::label("respuesta_1_' + indice + '", "Respuesta 1: ") !!}'+
                                        '<input class="form-control" name="respuesta_1_' + indice + '" type="text" id="respuesta_1_' + indice + '">'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '{!! Form::label("respuesta_2_' + indice + '", "Respuesta 2: ") !!}'+
                                        '<input class="form-control" name="respuesta_2_' + indice + '" type="text" id="respuesta_2_' + indice + '">'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '{!! Form::label("respuesta_3_' + indice + '", "Respuesta 3: ") !!}'+
                                        '<input class="form-control" name="respuesta_3_' + indice + '" type="text" id="respuesta_3_' + indice + '">'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '{!! Form::label("respuesta_4_' + indice + '", "Respuesta 4: ") !!}'+
                                        '<input class="form-control" name="respuesta_4_' + indice + '" type="text" id="respuesta_4_' + indice + '">'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '{!! Form::label("respuesta_correcta_' + indice + '", "Respuesta correcta: ") !!}'+
                                        '<input class="form-control" name="respuesta_correcta_' + indice + '" type="text" id="respuesta_correcta_' + indice + '">'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '{!! Form::label("question_type' + indice + '", "Tipo de pregunta: ") !!}'+
                                        '<input class="form-control" name="question_type_' + indice + '" type="text" id="respuesta_correcta_' + indice + '">'+
                                    '</div>'+
                                    '{{-- <div class="form-group">'+
                                        '{!! Form::label("imagen", "imagen: ") !!}'+
                                        '{!! Form::text("imagen", null, array("class" => "form-control")) !!}'+
                                    '</div> --}}'+
                                '</div>';
            document.getElementById('preguntas').innerHTML =  document.getElementById('preguntas').innerHTML + plantilla_a_agregar;

        }
    }
</script>