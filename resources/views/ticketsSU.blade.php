@extends('layouts.SULayout')

@section('header')
<?php
    if(!isset($state)){
        $state = "all";
    }
    if($state == "all"){
        $questions = DB::table('ticket_sus')->join('tickets', 'ticket_sus.id_ticket', '=', 'tickets.id_ticket')->join('estados', 'estados.id_estado', '=', 'ticket_sus.id_estado')->
                select('ticket_sus.id_ticket', 'tickets.pregunta', 'estados.estado', 'tickets.fecha_hora')->
                where([
                    ['ticket_sus.id_SU', '=', Auth::id()]
                ])->get();
    }
    elseif($state == "alto" || $state == "medio" || $state == "bajo"){
        $pendientes = DB::table('ticket_sus')->
                    select(DB::RAW('TIME_TO_SEC(TIMEDIFF(NOW(), ticket_sus.fecha_hora)) as secs'), 'ticket_sus.id_ticket', 'ticket_sus.prioridad', 'tickets.pregunta', 'estados.estado', 'tickets.fecha_hora')
                    ->join('tickets', 'ticket_sus.id_ticket', '=', 'tickets.id_ticket')
                    ->join('estados', 'estados.id_estado', '=', 'ticket_sus.id_estado')
                    ->where('id_SU', Auth::id())
                    ->get(); 
        $atrasados = array();
        foreach($pendientes as $pendiente){
            if($pendiente->estado!='Diferido' && $pendiente->estado!='Completado' && $pendiente->estado!='Sin Resolver'){
                if($pendiente->prioridad=="alto"){
                    if($pendiente->secs > 86400){
                        if($state=="alto"){
                            array_push($atrasados, $pendiente);
                        }
                    }
                }
                elseif($pendiente->prioridad=="medio"){
                    if($pendiente->secs > 172800){
                        if($state=="medio"){
                            array_push($atrasados, $pendiente);
                        }
                    }
                }
                elseif($pendiente->prioridad=="bajo"){
                    if($pendiente->secs > 259200){
                        if($state=="bajo"){
                            array_push($atrasados, $pendiente);
                        }
                    }
                }
            }
        }
        $questions = $atrasados;
    }
    elseif($state == "Sin_resolver"){
        $state = "Sin resolver";
        $questions = DB::table('ticket_sus')->join('tickets', 'ticket_sus.id_ticket', '=', 'tickets.id_ticket')->join('estados', 'estados.id_estado', '=', 'ticket_sus.id_estado')->
                select('ticket_sus.id_ticket', 'tickets.pregunta', 'estados.estado', 'tickets.fecha_hora')->
                where([
                    ['ticket_sus.id_SU', '=', Auth::id()],
                    ['estados.estado', '=', $state]
                ])->get();    
    }
    elseif(is_numeric($state))
    {
        echo("<script>
                window.onload = function() {
                    $('#radio".$state."').prop(\"checked\", true);
                    $.ajaxSetup({
                        headers: {
                                'X-CSRF-TOKEN': '".csrf_token()."'
                            }
                        })
                    $.post(\"/ajaxSRT\", {
                        'ticketid': ".$state."
                    },
                    function(data, status){
                        var json = JSON.parse(data);
                        var message = json.descripcion.replace(/\\n/g, \"<br />\");
                        $('#pregunta-container').show();
                        $('#pregunta').html(json.pregunta);
                        $('#descripcion').html(message);
                        $('#estado_actual').val(json.estado);
                        $('#detalles').val(json.detalles);
                        $('#porcentaje').val(json.porcentaje);
                        $('#prioridad').val(json.prioridad);
                        $('#ticket_su').val(json.id_ticketSU);
                        $('#state').val(json.id_estado);
                        $('#foro').attr(\"href\", \"/dashboard/foro/\"+json.id_ticketSU)
                        $('#llamadas').attr(\"href\", \"/dashboard/llamadas/\"+json.id_ticketSU)
                    });
                }

        
            </script>");
            $state = "all";
        $questions = DB::table('ticket_sus')->join('tickets', 'ticket_sus.id_ticket', '=', 'tickets.id_ticket')->join('estados', 'estados.id_estado', '=', 'ticket_sus.id_estado')->
                select('ticket_sus.id_ticket', 'tickets.pregunta', 'estados.estado', 'tickets.fecha_hora')->
                where([
                    ['ticket_sus.id_SU', '=', Auth::id()]
                ])->get();
    }
    else{
        $state = "all";
        $questions = DB::table('ticket_sus')->join('tickets', 'ticket_sus.id_ticket', '=', 'tickets.id_ticket')->join('estados', 'estados.id_estado', '=', 'ticket_sus.id_estado')->
                select('ticket_sus.id_ticket', 'tickets.pregunta', 'estados.estado', 'tickets.fecha_hora')->
                where([
                    ['ticket_sus.id_SU', '=', Auth::id()]
                ])->get();
    }
    
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
            @if($state=="all")
                
                <h1 class="page-header">Todos los Tickets</h1>
            @elseif($state=="alto")
                <h1 class="page-header">Tickets atrasados alta prioridad</h1>
            @elseif($state=="medio")
                <h1 class="page-header">Tickets atrasados media prioridad</h1>
            @elseif($state=="bajo")
                <h1 class="page-header">Tickets atrasados baja prioridad</h1>
            @else
                <h1 class="page-header">Tickets en {{$state}}</h1>
            @endif
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
                        <th>Fecha-hora</th>
                        <th>Estado</th>
                        <th>Pregunta</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($questions as $q)
                    <tr>
                    <td><label class="btn active">
                        {{ Form::radio('ticket', $q->id_ticket, false, ['id'=> 'radio'.$q->id_ticket, 'style'=>'display:none;']) }}<i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i>
                    </label></td>
                    <td>{{ $q->fecha_hora }}</td>
                    <td>{{ $q->estado }}</td>
                    <td>{{ $q->pregunta }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.row -->

    <section id="pregunta-container" class="section-padding" style="display:none;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span><h2 id="pregunta">YEI</h2><span>
            </div>
            <div class="panel-body">
                <b>Descripcion del problema:</b>
                <p id="descripcion">asdfasfds</p>
                <b>Imagen subida:</b>
                <img class="img-responsive" src="" alt="no-image" id="imgn">
            </div>
            <div class="panel-footer">
                <h4>Cambiar detalles del problema</h4>
                <b>Estado: </b>
                <form method="POST" action="/dashboard/tickets/update">
                    <div class="form-group">
                        <select id="estado_actual" name="estado_actual" class="form-control">
                            <option value="Nuevo">Nuevo</option>
                            <option value="Espera">Espera</option>
                            <option value="Diferido">Diferido</option>
                            <option value="Sin resolver">Sin resolver</option>
                            <option value="Completado">Completado</option>
                        </select>
                    </div>
                    <b>Detalles: </b>
                    <div class="form-group" >
                        <textarea name="detalles" id="detalles" class="form-control"></textarea>
                    </div>
                    <b>Porcentaje de conclusión</b>
                    <div class="form-group">
                        <input id="porcentaje" name="porcentaje" type="number" value="" min="0" max="100" class="form-control"/>
                    </div>
                    <b>Prioridad</b>
                    <div class="form-group">
                        <select id="prioridad" name="prioridad" class="form-control">
                            <option value="alto">alto</option>
                            <option value="medio">medio</option>
                            <option value="bajo">bajo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <input type="hidden" name="ticket_su" id="ticket_su" value="">
                        <input type="hidden" name="state" id="state" value="">
                        <input type="submit" class="btn btn-success" value="Guardar"></input>
                        <a id="foro" href=""><button class="btn btn-info" type="button"> Ir a foro</button></a>
                        <a id="llamadas" href=""><button class="btn btn-info" type="button"> Ir a llamadas</button></a>
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
             $('input[type=radio][name=ticket]').change(function() {
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
                $.post("/ajaxSRT", {
                    'ticketid': id
                },
                function(data, status){
                    var json = JSON.parse(data);
                    var message = json.descripcion.replace(/\n/g, "<br />");
                    $('#pregunta-container').show();
                    $('#pregunta').html(json.pregunta);
                    $('#descripcion').html(message);
                    $('#estado_actual').val(json.estado);
                    $('#detalles').val(json.detalles);
                    $('#porcentaje').val(json.porcentaje);
                    $('#prioridad').val(json.prioridad);
                    $('#ticket_su').val(json.id_ticketSU);
                    $('#state').val(json.id_estado);
                    $('#foro').attr("href", "/dashboard/foro/"+json.id_ticketSU)
                    $('#llamadas').attr("href", "/dashboard/llamadas/"+json.id_ticketSU)
                });
                $.post("/ajaxSRTI", {
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
            });
            
            } );

</script>

@endsection