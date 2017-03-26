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
    $count = 0;
    foreach($usuarios as $u){
        $count++;
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>@yield('title')</title>
        
        {{ HTML::style('css/dashboard/bootstrap.css') }}
        {{ HTML::style('css/dashboard/font-awesome.min.css') }}
        {{ HTML::style('css/dashboard/metisMenu.min.css') }}
        {{ HTML::style('css/dashboard/sb-admin-2.css') }}

        {{ HTML::script('js/dashboard/jquery.min.js') }}
        {{ HTML::script('js/dashboard/bootstrap.min.js') }}
        {{ HTML::script('js/dashboard/metisMenu.min.js') }}
        {{ HTML::script('js/dashboard/raphael.min.js') }}
        {{ HTML::script('js/dashboard/morris.min.js') }}
        {{ HTML::script('js/dashboard/sb-admin-2.js') }}
   {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js') }}
        {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.min.js') }}
        @section('header')
        @show
    </head>
    <body style="">
        <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand noSpace" href="/dashboard"><span style="color: #D71820">I</span><span style="color: #E05F25">H</span><span style="color: #DC771B">G</span></p></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                

                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="/logOut"><i class="fa fa-sign-out fa-fw"></i> Cerrar sesión</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="divider"></li>
                        <li>
                            <a href="/dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            @if($count>0)
                            <a href="/dashboard/newUsers" class="alert alert-danger"><i class="fa fa-user fa-fw"></i> Peticiones
                            <span class="pull-right ">
                            {{$count}}
                            </span>
                            </a>
                            @else
                            <a href="/dashboard/newUsers"><i class="fa fa-user fa-fw"></i> Peticiones
                            </a>
                            @endif
                        </li>
                        <li>
                            <a href="/dashboard/foro"><i class="fa fa-book"></i> Foro</a>
                        </li>
                        <li>
                            <a href="/dashboard/knowledge"><i class="fa fa-question"></i> Knowledge</a>
                        </li>
                        <li>
                            <a href="/dashboard/tickets/all"><i class="fa fa-file-text"></i> Tickets</a> 
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            @section('content')
            @show
        </div>
        <!-- /#page-wrapper -->

    </div>
    @section('footer')
    @show
    </body>
</html>