@extends('layouts.SULayout')

@section('header')
<?php
    $questions= DB::table('knowledge')->get();    
?>

    <style>
        label input[type="radio"] ~ i.fa.fa-circle-o{
            color: #c8c8c8;    display: inline;
        }
        label input[type="radio"] ~ i.fa.fa-dot-circle-o{
            display: none;
        }
        label input[type="radio"]:checked ~ i.fa.fa-circle-o{
            display: none;
        }
        label input[type="radio"]:checked ~ i.fa.fa-dot-circle-o{
            color: #7AA3CC;    display: inline;
        }
        label:hover input[type="radio"] ~ i.fa {
        color: #7AA3CC;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">knowledge</h1>
        </div>
        <div class="col-med-12">
            <a href="#pregunta-container"><button class="btn btn-info btn-lg btn-block" id="btn_newQuestiom">Crear nueva entrada</button></a>
        </div>
        <div class="col-med-12">
            <br>
        </div>
        <!-- /.col-lg-12 -->
    </div>
        <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
           <table id="knowledge" class="display cell-border stripe">
                <thead>
                    <tr>
                        <th>Seleccionar</th>
                        <th>Tema</th>
                        <th>Pregunta</th>
                        <th>Respuesta</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($questions as $q)
                    <tr>
                    <td><label class="btn active">
                        {{ Form::radio('ticket', $q->id, false, ['id'=> 'radio'.$q->id, 'style'=>'display:none;']) }}<i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i>
                    </label></td>
                        <td>{{ $q->tema }}</td>
                        <td>{{ $q->pregunta }}</td>
                        <td>{{ $q->respuesta }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.row -->
    <?php 
        $temas= DB::table('knowledge')->select('tema')->groupBy('tema')->get();
    ?>
    
    <section id="pregunta-container" class="section-padding" style="display:none;">
        <div class="panel panel-default">
            <div class="panel-body">
                <form action="/dashoard/knowledge/submit" method="post">
                    <div class="form-group">
                        <label>Tema:</label>
                        <select id="select_tema" name="select_tema" class="form-control">
                            @foreach($temas as $t)
                                <option value="{{$t->tema}}">{{$t->tema}}</option>
                            @endforeach
                                <option value="null">Otro</option>
                        </select>
                        <label id="label_input_tema" for="input_tema" style="display:none;">Escribelo:</label>
                        <input type="text" name="input_tema" id="input_tema" class="form-control" style="display:none;"/>
                    </div>
                    <div class="form-group">
                        <label for="pregunta">Pregunta:</label>
                        <input type="text" name="pregunta" id="pregunta" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="respuesta">Respuesta:</label>
                        <textarea name="respuesta" id="respuesta" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="number" id="id" name="id" hidden/>
                        {{ csrf_field() }}
                        <input type="submit" value="Guardar" class="btn btn-success"/>
                        <input type="submit" class="btn btn-danger" value="Eliminar"/>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection

@section('footer')
<?php

?>
<script>
            $(document).ready( function () {
                $('#knowledge').DataTable( {
                  "language": {
                      "decimal":        ".",
                      "lengthMenu": "Mostrar _MENU_ preguntas por página",
                      "zeroRecords": "Nada encontrado - lo sentimos",
                      "info": "Mostrando pagina _PAGE_ de _PAGES_",
                      "infoEmpty": "No hay registros disponibles",
                      "infoFiltered": "(Filtrando de _MAX_ registros)",
                      "loadingRecords": "Cargando...",
                      "processing":     "Procesando...",
                      "search":         "Buscar:",
                      "paginate": {
                          "first":      "Primero",
                          "last":       "Ultimo",
                          "next":       "Siguiente",
                          "previous":   "Anterior"
                      }
                  },
                  bAutoWidth: false , 
                  aoColumns : [
                      { sWidth: '10%' },
                      { sWidth: '15%' },
                      { sWidth: '10%' },
                      { sWidth: '65%' },

                  ],
                  "order": [[ 1, "desc" ]]
                });
             $('#select_tema').on('change', function() {
                if($('#select_tema').val()=="null")
                {
                    $('#label_input_tema').show();
                    $('#input_tema').show();
                }
                else
                {
                    $('#label_input_tema').hide();
                    $('#input_tema').hide();
                }
             });
             $('input[type=radio][name=ticket]').change(function() {
                var csrfVal="{{ csrf_token() }}";
                @foreach ($questions as $key => $q)
                    @if($key==0)
                        if (this.value == {{$q->id}}) {
                            id=$('input:radio[name=ticket]:checked').val();
                        }
                    @else
                        else if (this.value == {{$q->id}}) {
                            id=$('input:radio[name=ticket]:checked').val();
                        }
                    @endif
                @endforeach
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': csrfVal
                    }
                })
                $.post("/ajaxFAQ", {
                    'id': id
                },
                function(data, status){
                    var json = JSON.parse(data);
                    var answer = json.respuesta.replace(/\n/g, "<br />");
                    $('#pregunta-container').show();
                    $('#pregunta').val(json.pregunta);
                    $('#respuesta').html(answer);
                    $('#id').val(json.id);
                    $('#select_tema').val(json.tema);
                });
            });
            $("#btn_newQuestiom").click(function(){
                $('#pregunta-container').show();
                $('#pregunta').val("");
                $('#respuesta').html("");
                $('#id').val(null);
                $('#label_input_tema').show();
                $('#input_tema').show();
                $('#select_tema').val("null");
            }); 
            } );

</script>

@endsection