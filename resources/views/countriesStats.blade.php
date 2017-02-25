<?php
    
    $paises = DB::table('tickets')->join('users', 'users.id', '=', 'tickets.id_mortal')->join('countries', 'users.id_region', '=', 'countries.id')->
                select(DB::RAW('count(id_mortal) AS totales'), 'countries.name', 'countries.id')->groupBy('id_mortal')->get();
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
@extends('layouts.SULayout')

@section('header')
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
            <h1 class="page-header">Estadisticas por paises</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
        <section id="pregunta-container" class="section-padding">
            <div class="panel panel-default">
                @foreach($count as $key => $c)
                    <div class="panel-heading">
                    <span class="pull-right alert alert-warning">
                                {{$c[0]}}
                            </span>
                        <h3 id="user">{{$c[1]}} 
                        </h3>  
                    </div>
                    <div class="panel-body">
                        <?php
                            $usuarios = DB::table('users')->select('users.*', DB::raw('count(tickets.id_mortal) as conteo'))
                                        ->join('mortals', 'mortals.id_usuario', 'users.id')
                                        ->join('tickets', 'mortals.id_usuario', 'tickets.id_mortal')
                                        ->where('users.id_region', $key)
                                        ->groupBy('tickets.id_mortal')
                                        ->get();
                        ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Celular</th>
                                    <th>Telefono</th>
                                    <th>Extension</th>
                                    <th>Area</th>
                                    <th>Trabajo</th>
                                </tr>
                            </thead>
                            @foreach($usuarios as $u)
                                <tr>
                                    <td>{{$u->nombre}} {{$u->apellido}}</td>
                                    <td>{{$u->email}}</td>
                                    <td>{{$u->cel}}</td>
                                    <td>{{$u->tel}}</td>
                                    <td>{{$u->ext}}</td>
                                    <td>{{$u->areaTrabajo}}</td>
                                    <td>{{$u->trabajo}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @endforeach
            </div>
            
        </section>

@endsection

@section('footer')
<?php

?>
<script>
           
</script>

@endsection