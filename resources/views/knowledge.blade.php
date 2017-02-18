<!DOCTYPE html>
<html lang="es">
    <head>
        <title>@yield('title')</title>
        
        {{ HTML::style('css/bootstrap.min.css') }}
        {{ HTML::style('css/imagehover.min.css') }}
        {{ HTML::style('css/style.css') }}
        {{ HTML::style('css/font-awesome.min.css') }}
        {{ HTML::script('js/jquery.min.js') }}
        {{ HTML::script('js/jquery.min.js') }}
        {{ HTML::script('js/jquery.easing.min.js') }}
        {{ HTML::script('js/bootstrap.min.js') }}
        {{ HTML::script('js/custom.js') }}
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>
    </head>
    <body style="padding-top:70px;">
        <!--Navigation bar-->
        <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Tech<span>-service</span></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="dashboard">Tickets</a></li>
              <li><a href="knowledge">knowledge</a></li>
              <li class="btn-trial"><a href="logOut">Cerrar Sesión</a></li>
            </ul>
            </div>
        </div>
        </nav>
         
        <!--Feature-->
        
        <section id ="feature" class="section-padding">
        <?php
          $questions= DB::table('knowledge')->get();
        ?>
        <div class="container">
            <div class="row">
              <div class="col-med-16">
                <table id="knowledge" class="display">
                  <thead>
                      <tr>
                          <th>Tema</th>
                          <th>Pregunta</th>
                          <th>Respuesta</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($questions as $q)
                      <tr>
                        <td>{{ $q->tema }}</td>
                        <td>{{ $q->pregunta }}</td>
                        <td>{{ $q->respuesta }}</td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
              </div>
            </div>
        </div>
        </section>
        <!--/ feature-->
        <!--Footer-->
    <footer id="footer" class="footer">
      <div class="container text-center">

        ©2017 Tech-Service. Todos los derechos reservados
        <div class="credits">
            <!-- 
                All the links in the footer should remain intact. 
                You can delete the links only if you purchased the pro version.
                Licensing information: https://bootstrapmade.com/license/
                Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Mentor
            -->
            Designed by <a href="https://bootstrapmade.com/">Free Bootstrap Themes</a>
        </div>
      </div>
    </footer>
    <!--/ Footer-->
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
                  }
                });
            } );
        </script>
    </body>
</html>