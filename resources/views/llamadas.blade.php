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
<?php
    $llamadas = DB::table('llamadas')->where('id_ticket_su', $id)->orderBy('fecha_hora', 'desc')->get();
?>
@section('content')
<div class="chat-panel panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-comments fa-fw"></i> Llamadas
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <ul class="chat">
                                @foreach($llamadas as $l)
                                    <li>
                                        <div class="chat-body clearfix">
                                            <div class="header">
                                                <strong class="primary-font"><i class="fa fa-clock-o fa-fw"></i>{{$l->fecha_hora}}</strong>
                                            </div>
                                            <p>
                                                <?php echo(nl2br($l->detalles)); ?>
                                            </p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- /.panel-body -->
                        <div class="panel-footer">
                            <form action="/dashoard/llamadas/{{$id}}/submit" method="post">
                                <div class="form-group">
                                    <textarea id="detalles" name="detalles" type="text" class="form-control" placeholder="Escribe aqui lo que desees guardar de la llamada"></textarea>
                                </div>
                                <div class="form-group">
                                    {{ csrf_field() }}
                                    <input type="submit" class="btn btn-warning btn-sm" id="btn-chat"/>
                                </div>
                            </form>
                        </div>
                        <!-- /.panel-footer -->
                    </div>

@endsection

@section('footer')
<?php

?>
<script>


</script>

@endsection