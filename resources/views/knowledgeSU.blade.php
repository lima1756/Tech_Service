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
    
    <!-- include summernote css/js-->
    <link href="/dist/summernote.css" rel="stylesheet">
    <script src="/dist/summernote.js"></script>

    <!-- include summernote-es-ES -->
    <script src="/dist/lang/summernote-es-ES.js"></script>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">knowledge</h1>
        </div>
        <div class="col-med-12">
            <button class="btn btn-info btn-lg btn-block" id="btn_newQuestiom">Crear nueva entrada</button>
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
                        <th>Titulo</th>
                        <th>Etiqueta</th>
                        <th>Fecha</th>
                        <th>Visitas</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($questions as $q)
                    <tr>
                    <td><label class="btn active">
                        {{ Form::radio('entrada', $q->id, false, ['id'=> 'radio'.$q->id, 'href' => '#pregunta-container' ,'style'=>'display:none;']) }}<i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i>
                    </label></td>
                        <td>{{ $q->titulo }}</td>
                        <td>{{ $q->tema }}</td>
                        <td><?php echo date_format(new dateTime($q->fecha_hora), 'd-m-Y H:i:s'); ?></td>
                        <td>{{ $q->visitas }}</td>
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
                <form action="/dashboard/knowledge/submit" method="post" id="formulario">
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
                        <label for="Titulo">Titulo:</label>
                        <input type="text" name="Titulo" id="Titulo" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="contenido">Contenido:</label>
                        <textarea  id="summernote" name="content"></textarea >
                    </div>
                    <div class="form-group">
                        <input type="number" id="id" name="id" hidden/>
                        {{ csrf_field() }}
                        <button onclick="saveF(); return false;" id="guardar" class="btn btn-success">Guardar</button>
                        <button onclick="resetear(); return false;" id="resetear" class="btn btn-warning" style="display:none;">Resetear</button>
                        <button onclick="deleteF(); return false;" id="eliminar" class="btn btn-danger" />Eliminar</button>
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
var json = JSON;
            $(document).ready( function () {
                //DataTable
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
                      { sWidth: '6%' },
                      { sWidth: '54%' },
                      { sWidth: '10%' },
                      { sWidth: '10%' },
                      { sWidth: '10%' }

                  ],
                  "order": [[ 3, "desc" ]]
                });
            //Summernote
            $('#summernote').summernote({
                height: 300,
                lang:   'es-ES'
            });
            //Selector de tema
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
             //Ajax para obtencion de datos en seleccion
             $('input[type=radio][name=entrada]').change(function() {
                var csrfVal="{{ csrf_token() }}";
                @foreach ($questions as $key => $q)
                    @if($key==0)
                        if (this.value == {{$q->id}}) {
                            id=$('input:radio[name=entrada]:checked').val();
                        }
                    @else
                        else if (this.value == {{$q->id}}) {
                            id=$('input:radio[name=entrada]:checked').val();
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
                    json = JSON.parse(data);
                    $('#pregunta-container').show();
                    $('#Titulo').val(json.titulo);
                    $('#summernote').summernote('code', json.contenido);
                    $('#resetear').show();
                    $('#id').val(json.id);
                    $('#select_tema').val(json.tema);
                    $('#eliminar').show();
                    $('#label_input_tema').hide();
                    $('#input_tema').hide();
                    $('html, body').animate({
                        scrollTop: $("#pregunta-container").offset().top
                    }, 1000);
                });
            });
            //Nuevo knowledge
            $("#btn_newQuestiom").click(function(){
                $('input[type=radio][name=entrada]').prop('checked', false);
                $('#pregunta-container').show();
                $('#Titulo').val("");
                $('#summernote').summernote('code', "");
                $('#id').val(null);
                $('#label_input_tema').show();
                $('#input_tema').show();
                $('#select_tema').val("null");
                $('#resetear').hide();
                $('#eliminar').hide();
                $('html, body').animate({
                    scrollTop: $("#pregunta-container").offset().top
                }, 1000);
            }); 

            

            } );
            function resetear()
            {
                
                $('#pregunta-container').show();
                $('#Titulo').val(json.titulo);
                $('#summernote').summernote('code', json.contenido);
                $('#id').val(json.id);
                $('#select_tema').val(json.tema);
                
            }

            function saveF()
            {
                $('#formulario').prop('action', '/dashboard/knowledge/submit');
                
                $('#formulario').submit();
            }

            function deleteF()
            {
                $('#formulario').prop('action', '/dashboard/knowledge/drop');
                
                $('#formulario').submit();
            }
            
</script>

@endsection