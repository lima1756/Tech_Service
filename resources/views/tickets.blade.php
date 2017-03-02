 <?php
if(isset($state))
if(is_numeric($state))
    {
        echo("<script>
                window.onload = function() {
                    $('#radio".$state."').prop(\"checked\", true);
                    $.ajaxSetup({
                        headers: {
                                'X-CSRF-TOKEN': '".csrf_token()."'
                            }
                        })
                $.post(\"/ajaxMRT\", {
                    'ticketid': ".$state."
                },
                function(data, status){
                    var json = JSON.parse(data);
                    var message = json.descripcion.replace(/\\n/g, \"<br />\");
                    $('#pregunta-container').show();
                    $('#pregunta').html(json.pregunta);
                    $('#descripcion').html(message);
                });
                $.post(\"/ajaxMRTI\", {
                    'ticketid': ".$state."
                },
                function(data, status){
                    if(data==\"-1\"){
                        $('#imgn').attr(\"src\", \"\")
                        $('#imgn').attr('alt', 'No se subió ninguna imagen');
                    }
                    else{
                        var json = JSON.parse(data);
                        $('#imgn').attr(\"src\", \"/storage/ticketImages/\" + json.nombre)
                        $('#imgn').attr('alt', 'img');
                    }
                });
                 $.post(\"/ajaxMRTSI\", {
                    'ticketid': ".$state."
                },
                function(data, status){
                    var json = JSON.parse(data);
                    $('#progressbar').attr(\"style\", \"width:\"+json.porcentaje+\"%\");
                    $('#barValue').html(json.porcentaje+\"% Resuelto\");
                    if(json.porcentaje<60){
                        $('#progressbar').attr(\"class\", \"progress-bar progress-bar-danger\");
                    }
                    else if(json.porcentaje<90){
                        $('#progressbar').attr(\"class\", \"progress-bar progress-bar-warning\");
                    }
                    else if(json.porcentaje<101){
                        $('#progressbar').attr(\"class\", \"progress-bar progress-bar-success\");
                    }
                    if (typeof json.estado !== 'undefined') {
                        $('#estado-actual').html(json.estado);
                    }
                    else{
                        $('#estado-actual').html('Sin asignar');
                    }
                    if (typeof json.detalles !== 'undefined') {
                        if(json.detalles=\"NULL\"){
                            $('#detalles').html(\"No hay detalles aun\");
                        }
                        else{
                            $('#detalles').html(json.detalles);
                        }
                    }
                    else{
                        $('#detalles').html('Sin detalles');
                    }
                });
                }

        
            </script>");
    }
?>
@extends('layouts.mortalLayout')
    @section('feature')
   
        <!--Feature-->
        <section id ="feature" class="section-padding">
        <?php
          $questions = DB::table('tickets')->where('id_mortal', Auth::id())->get();
        ?>
        <div class="container" style="margin-top:10px;">
            <div class="row">
                @if(isset($error))
                <div class="col-med-12">
                    <div class="alert alert-danger">
                        <strong>Error!</strong> Archivo no valido. Porfavor vuelva a intentarlo
                    </div>
                </div>
                @endif
                <div class="col-med-12">
                    <a href="#newTicket-Container"><button class="btn btn-info btn-lg btn-block" id="btn_newTicket">Crear nuevo ticket</button></a>
                </div>
            </div>
        </div>
        <div class="container" style="margin-top:20px;">
            <div class="row">
                <div class="col-med-12">
                    <div class="page-header">
                        <h1>Mis tickets: <small>Selecciona el ticket del que desees ver mas informacion</small></h1>
                    </div>
                </div>
              <div class="col-med-12">
                <table id="knowledge" class="display cell-border stripe">
                  <thead>
                      <tr>
                          <th>Seleccionar</th>
                          <th>Fecha-hora</th>
                          <th>Pregunta</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($questions as $q)
                      <tr>
                        <td><label class="btn active">
                            {{ Form::radio('ticket', $q->id_ticket, false, ['id'=> $q->id_ticket, 'style'=>'display:none;']) }}<i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i>
                        </label></td>
                        <td>{{ $q->fecha_hora }}</td>
                        <td>{{ $q->pregunta }}</td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
              </div>
            </div>
        </div>
        </section>
        <!--/ feature-->
        <section id="pregunta-container" class="section-padding" style="background-color:#e1e1ea; display:none;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <span style="float:right;">
                                    <div class="progress" id="progress">
                                        <div class="progress-bar progress-bar-danger" id="progressbar" role="progressbar" aria-valuenow="01"
                                        aria-valuemin="0" aria-valuemax="100" style="width:01%">
                                            <font color="black" id="barValue">00% Resuelto</font>
                                        </div>
                                    </div>
                                </span>
                                <span><h2 id="pregunta">YEI</h2><span>
                            </div>
                            <div class="panel-body">
                                <b>Descripcion del problema:</b>
                                <p id="descripcion">asdfasfds</p>
                                <b>Imagen subida:</b>
                                <img class="img-responsive" src="" alt="no-image" id="imgn">
                            </div>
                            <div class="panel-footer">
                                <b>Estado: </b>
                                <p id="estado-actual">Estado Problema</p>
                                <b>Detalles</b>
                                <p id="detalles">Detalles :D</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section id="newTicket-Container" class="section-padding" style="background-color:#e1e1ea; display:none;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Llene los siguientes campos y envie su ticket</h3>
                        <form method="post" action="/tickets/newTicket" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="preguntaForm">Pregunta:</label>
                                <input type="text" class="form-control" id="preguntaForm" name="preguntaForm" required/>
                            </div>
                            <div class="form-group">
                                <label for="descripcionForm">Descripcion del problema:</label>
                                <textarea class="form-control" rows="5" id="descripcionForm" name="descripcionForm" required></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Seleccione una imagen para adjuntar (.jpg o .png)</label>
                                <input id="imgForm" name="imgForm" type="file" class="file">
                            </div>
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-success">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @endsection
    @section('extra')
        <script type="text/javascript">
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
                      { sWidth: '75%' },

                  ],
                  "order": [[ 1, "desc" ]]
                });
             $('input[type=radio][name=ticket]').change(function() {
                var id=-1;
                var xmlhttp;
                var contenidosRecibidos= new Array();
                var csrfVal="{{ csrf_token() }}";
                @foreach ($questions as $key => $q)
                    @if($key==0)
                        if (this.value == {{$q->id_ticket}}) {
                            id=$('input:radio[name=ticket]:checked').val();
                        }
                    @else
                        else if (this.value == {{$q->id_ticket}}) {
                            id=$('input:radio[name=ticket]:checked').val();
                        }
                    @endif
                @endforeach
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': csrfVal
                    }
                })
                $.post("/ajaxMRT", {
                    'ticketid': id
                },
                function(data, status){
                    var json = JSON.parse(data);
                    var message = json.descripcion.replace(/\n/g, "<br />");
                    $('#pregunta-container').show();
                    $('#pregunta').html(json.pregunta);
                    $('#descripcion').html(message);
                });
                $.post("/ajaxMRTI", {
                    'ticketid': id
                },
                function(data, status){
                    if(data=="-1"){
                        $('#imgn').attr("src", "")
                        $('#imgn').attr('alt', 'No se subió ninguna imagen');
                    }
                    else{
                        var json = JSON.parse(data);
                        $('#imgn').attr("src", "/storage/ticketImages/" + json.nombre)
                        $('#imgn').attr('alt', 'img');
                    }
                });
                 $.post("/ajaxMRTSI", {
                    'ticketid': id
                },
                function(data, status){
                    var json = JSON.parse(data);
                    $('#progressbar').attr("style", "width:"+json.porcentaje+"%");
                    $('#barValue').html(json.porcentaje+"% Resuelto");
                    if(json.porcentaje<60){
                        $('#progressbar').attr("class", "progress-bar progress-bar-danger");
                    }
                    else if(json.porcentaje<90){
                        $('#progressbar').attr("class", "progress-bar progress-bar-warning");
                    }
                    else if(json.porcentaje<101){
                        $('#progressbar').attr("class", "progress-bar progress-bar-success");
                    }
                    if (typeof json.estado !== 'undefined') {
                        $('#estado-actual').html(json.estado);
                    }
                    else{
                        $('#estado-actual').html('Sin asignar');
                    }
                    if (typeof json.detalles !== 'undefined') {
                        if(json.detalles="NULL"){
                            $('#detalles').html("No hay detalles aun");
                        }
                        else{
                            $('#detalles').html(json.detalles);
                        }
                    }
                    else{
                        $('#detalles').html('Sin detalles');
                    }
                });
                
            });
            
            } );
            $("#btn_newTicket").click(function(){
                $('#pregunta-container').hide();
                $('#newTicket-Container').show();
            });
        </script>
    @endsection