@extends('layouts.mortalLayout')
    @section('feature')
        <!--Feature-->
        
        <section id ="feature" class="section-padding">
        <?php
          $questions= DB::table('knowledge')->get();
        ?>
        <div class="container">
            <div class="row">
                <div class="col-med-12">
                    <div class="page-header">
                        <h1>Busque su duda: <small>Use el buscador para mayor rapidez</small></h1>
                    </div>
                </div>
                <div class="col-med-12">
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
                  }
                });
            } );
        </script>
    @endsection