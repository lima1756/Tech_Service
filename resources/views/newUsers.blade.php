<?php
    
    $usuarios = DB::table(DB::raw('(
                            SELECT supers.* FROM (
                                SELECT users.* FROM `users` 
                                LEFT JOIN superusers 
                                ON id = superusers.id_usuario 
                                WHERE superusers.id_usuario IS NULL
                            ) AS supers LEFT JOIN mortals
                            ON supers.id = mortals.id_usuario 
                            WHERE mortals.id_usuario IS NULL
                        ) AS usuarioComun'))->leftJoin('informes', 'usuarioComun.id', '=', 'informes.id_usuario')
                        ->whereNULL('informes.id_usuario')->get();
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
            <h1 class="page-header">Usuarios por verificar</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
        <section id="pregunta-container" class="section-padding">
            <div class="panel panel-default">
                @foreach($usuarios as $u)
                    <div class="panel-heading">
                        <h3 id="user">{{$u->nombre}} {{$u->apellido}}
                            <span class="pull-right">
                                <a href="/dashboard/newUsers/SU/{{$u->id}}"><button class="btn btn-success">Nuevo SU</button></a>
                                <a href="/dashboard/newUsers/user/{{$u->id}}"><button class="btn btn-warning">Nuevo usuario</button></a>
                                <a href="/dashboard/newUsers/delete/{{$u->id}}"><button class="btn btn-danger">Denegar</button></a>
                            </span>
                        </h3>  
                    </div>
                    <div class="panel-body">
                        <p>email: {{$u->email}}</p>
                        <p>Celular: {{$u->cel}}</p>
                        <p>Telefono: {{$u->tel}}</p>
                        <p>Extension: {{$u->ext}}</p>
                        <p>Area de Trabajo: {{$u->areaTrabajo}}</p>
                        <p>Trabajo: {{$u->trabajo}}</p>
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