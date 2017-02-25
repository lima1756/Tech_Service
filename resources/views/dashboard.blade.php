@extends('layouts.SULayout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
        <!-- /.row -->

    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-pie-chart fa-fw"></i> Estado de solicitudes
                </div>
                <div class="panel-body">
                    <div id="estado-solicitud"></div>
                    <div class="text-center">
                            <a href="/dashboard/tickets/Espera"><button class="btn btn-info">Ver en espera</button></a>
                            <a href="/dashboard/tickets/Nuevo"><button class="btn btn-info">Ver nuevos</button></a>
                            <a href="/dashboard/tickets/Diferido"><button class="btn btn-info">Ver diferidos</button></a>
                        </div>
                </div>
                <!-- /.panel-body -->
            </div>
            
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Solicitudes
                    <div class="pull-right">
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                        <div id="solicitudes"></div>
                        <div class="text-center">
                            <a href="/dashboard/tickets/Completado"><button class="btn btn-info">Ver Completadas</button></a>
                            <a href="/dashboard/tickets/Sin_resolver"><button class="btn btn-info">Ver Sin resolver</button></a>
                            <a href="/dashboard/tickets/all"><button class="btn btn-info">Ver Total</button></a>
                        </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            
        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-file-text-o fa-fw"></i> Atrasados
                </div>
                <?php 
                    $pendientes = DB::table('ticket_sus')->select(DB::RAW('TIME_TO_SEC(TIMEDIFF(NOW(), ticket_sus.fecha_hora)) as secs'), 'prioridad', 'estado')->join('estados', 'estados.id_estado', '=', 'ticket_sus.id_estado')->where('id_SU', Auth::id())->get(); 
                    $atrasados = array();
                    $atrasados[0]=0;
                    $atrasados[1]=0;
                    $atrasados[2]=0;
                    foreach($pendientes as $pendiente){
                        if($pendiente->estado!='Diferido' && $pendiente->estado!='Completado' && $pendiente->estado!='Sin Resolver')
                        if($pendiente->prioridad=="alto"){
                            if($pendiente->secs > 86400){
                                $atrasados[0]++;
                            }
                        }
                        elseif($pendiente->prioridad=="medio"){
                            if($pendiente->secs > 172800){
                                $atrasados[1]++;
                            }
                        }
                        elseif($pendiente->prioridad=="bajo"){
                            if($pendiente->secs > 259200){
                                $atrasados[2]++;
                            }
                        }
                    }
                ?>
                
                <div class="panel-body">
                <h3>Prioridad: </h3>
                <a href="/dashboard/tickets/alto"><h4>Alta: </h4> <p>{{$atrasados[0]}}</p></a>
                <a href="/dashboard/tickets/medio"><h4>Media: </h4> <p>{{$atrasados[1]}}</p></a>
                <a href="/dashboard/tickets/bajo"><h4>Baja: </h4> <p>{{$atrasados[2]}}</p></a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-pie-chart fa-fw"></i> Solicitudes por paises
                </div>
                <div class="panel-body">
                    <div id="paises"></div>
                    <div class="text-center">
                        <a href="/dashboard/countriesStats"><button class="btn btn-info">Ver informacion</button></a>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
@endsection

@section('footer')
<?php
    $paises = DB::table('tickets')->join('users', 'users.id', '=', 'tickets.id_mortal')->join('countries', 'users.id_region', '=', 'countries.id')->
                select(DB::RAW('count(id_mortal) AS totales'), 'countries.name', 'countries.id')->groupBy('id_mortal')->get();
    $estados = DB::table('estados')->join('ticket_sus', 'estados.id_estado', '=', 'ticket_sus.id_estado')->
                select(DB::RAW('count(estados.estado) AS conteo'), 'estados.estado')->where('id_SU', Auth::id())->groupBy('estados.estado')->get();
    $total = 0;
    foreach($estados as $p):
        if($p->estado == "Completado" || $p->estado == "Sin resolver"):
            $total+=$p->conteo;
        endif;
    endforeach;
    $count = array();
    foreach($paises as $pais){
        if(isset($count[$pais->id])){
            $count[$pais->id][0]+=$pais->totales;
        }
        else{
            $count[$pais->id]=[0, $pais->name];
            $count[$pais->id][0]+=$pais->totales;
        }
    }
?>
<script>
Morris.Donut({
  element: 'paises',
  data: [
    @foreach($count as $c)
        {label: '{{$c[1]}}', value: {{$c[0]}}},
    @endforeach
  ]
});
Morris.Donut({
  element: 'estado-solicitud',
  data: [
    @foreach($estados as $p)
        @if($p->estado == "Nuevo" || $p->estado == "Espera" || $p->estado == "Diferido")
            {label: '{{$p->estado}}', value: {{$p->conteo}}},
        @endif
    @endforeach
  ]
});

Morris.Bar({
  element: 'solicitudes',
    data: [
        @foreach($estados as $p)
            @if($p->estado == "Completado" || $p->estado == "Sin resolver")
                {x: '{{$p->estado}}', y: {{$p->conteo}}},
            @endif
        @endforeach
        {x: 'Total', y: {{$total}}}

  ],
  xkey: 'x',
  ykeys: 'y',
  labels: 'Graficas'
});
</script>

@endsection