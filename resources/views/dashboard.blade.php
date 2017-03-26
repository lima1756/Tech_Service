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
    $misPaises = array();
    $misConteos = array();
    $misColores = array();
    $misColores2 = array();
    foreach($count as $c):
        array_push($misPaises, $c[1]);
        array_push($misConteos, $c[0]);
        $uno = rand(1,255);
        $dos = rand(1,255);
        $tres = rand(1,255);
        array_push($misColores, 'rgba('.$uno.', '.$dos.', '.$tres.', 0.5)');
        array_push($misColores2, 'rgba('.$uno.', '.$dos.', '.$tres.', 1)');
    endforeach;
    $conteos = array();   
    foreach($estados as $p)
    {
            $conteos[$p->estado] = $p->conteo;
    }
    if(!isset($conteos['Nuevo']))
    {
        $conteos['Nuevo']=0;
    }
    if(!isset($conteos['Espera']))
    {
        $conteos['Espera']=0;
    }
    if(!isset($conteos['Diferido']))
    {
        $conteos['Diferido']=0;
    }
    if(!isset($conteos['Completado']))
    {
        $conteos['Completado']=0;
    }
    if(!isset($conteos['Sin resolver']))
    {
        $conteos['Sin resolver']=0;
    }
    $estadoSolicitudes = app()->chartjs
                                ->name('estadoSolicitudes')
                                ->type('pie')
                                ->labels(['Espera', 'Nuevos', 'Diferidos'])
                                ->datasets([
                                    [
                                        'backgroundColor' => ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(54, 162, 150, 0.5)'],
                                        'hoverBackgroundColor' => ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(54, 162, 150, 1)'],
                                        'data' => [$conteos['Espera'], $conteos['Nuevo'], $conteos['Diferido']]
                                    ]
                                ])
                                ->options([]);
    $graficaPaises = app()->chartjs
                            ->name('paisesGraph')
                            ->type('pie')
                            ->labels($misPaises)
                            ->datasets([
                                [
                                    'backgroundColor' => $misColores,
                                    'hoverBackgroundColor' => $misColores2,
                                    'data' => $misConteos
                                ]
                            ])
                            ->options([]);

    $solicitudes = app()->chartjs
                                    ->name('Solicitudes')
                                    ->type('bar')
                                    ->labels(['Solicitudes'])
                                    ->datasets([
                                        [
                                            "label" => "Completados",
                                            'backgroundColor' => ['rgba(255, 99, 132, 0.5)'],
                                            'data' => [$conteos['Completado']]
                                        ],
                                        [
                                            "label" => "Sin Resolver",
                                            'backgroundColor' => ['rgba(54, 162, 235, 0.5)'],
                                            'data' => [$conteos['Sin resolver']]
                                        ],
                                        [
                                            "label" => "Total",
                                            'backgroundColor' => ['rgba(54, 162, 150, 0.5)'],
                                            'data' => [ $total]
                                        ]
                                    ])
                                    ->options([
                                        'scales'=> [
                                            'yAxes'=> [[
                                                'ticks'=> [
                                                    'beginAtZero'=>'true'
                                                ]
                                            ]]
                                        ]


                                    ]);


?>

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
                    <div id="estado-solicitud">
                    <?php
                        echo $estadoSolicitudes->render();
                    ?>

      
                    
                    </div>
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
                        <div id="solicitudes">
                            <?php echo $solicitudes->render();
                            
                        ?>
                        </div>
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
                    <div id="paises">
                        <?php
                            echo $graficaPaises->render();
                        ?>
                    </div>
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

<script>


</script>

@endsection

