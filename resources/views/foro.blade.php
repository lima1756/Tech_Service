<?php
    $foro = array();
    if(isset($id)){
        $number = DB::table('notas')->where('id_nota', null)->where('id_ticket_su', $id)->get();
        while(count($number)>0){
            array_push($foro, $number[0]);
            $number = DB::table('notas')->where('id_nota', $number[0]->id)->get();            
        }
    }
    else{
        $foro = DB::table('notas')->where('id_nota', null)->get();
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
            <h1 class="page-header">Foro</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    @if(isset($id))
        <section id="pregunta-container" class="section-padding">
            <div class="panel panel-default">
                @foreach($foro as $f)
                    <?php
                        $name = DB::table('users')->select('nombre')->where('id', $f->id_SU)->get();
                    ?>
                    <div class="panel-heading">
                        <span><h3 id="user">{{$name[0]->nombre}}:</h3><span>
                    </div>
                    <div class="panel-body">
                        <p>{{$f->mensaje}}</p>
                    </div>
                @endforeach
            </div>
            <div class="panel panel-default">
                    <div class="panel-heading">
                        <span><h2>Contestar</h2><span>
                    </div>
                    <div class="panel-body">
                        <form action="nuevo" method="post">
                            <div class="form-group">
                                <?php
                                    if(count($foro)>0){
                                        $last=$foro[count($foro)-1]->id;
                                    }
                                    else{
                                        $last=null;
                                    }
                                ?>
                                <textarea class="form-control" name="comentario" id="comentario"></textarea>
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <input type="hidden" name="last" value="{{$last}}">
                                <input type="hidden" name="id_ticket_su" value="{{$id}}">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Enviar" class="btn btn-success"/>
                            </div>
                        </form>
                    </div>
            </div>
        </section>
    @else
        <section id="pregunta-container" class="section-padding">
            <div class="panel panel-default">
                @foreach($foro as $f)
                    <?php
                        $name = DB::table('users')->select('nombre')->where('id', $f->id_SU)->get();
                    ?>
                    <div class="panel-heading">
                        <a href="/dashboard/foro/{{$f->id_ticket_su}}"><span><h3 id="user">Pregunta: {{$f->mensaje}}</h3><span></a>
                    </div>
                    <div class="panel-body">
                        <p>Escrito por: {{$name[0]->nombre}}</p>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

@endsection

@section('footer')
<?php

?>
<script>
           
</script>

@endsection