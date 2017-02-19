@extends('layouts.mortalLayout')
    @section('feature')
        <!--Feature-->
        <section id ="feature" class="section-padding">
        <?php
          $questions = DB::table('tickets')->where('id_mortal', Auth::id())->get();
        ?>
        <div class="container" style="margin-top:10px;">
            <div class="row">
                <div class="col-med-12">
                    <button class="btn btn-info btn-lg btn-block">Crear nuevo ticket</button>
                </div>
            </div>
        </div>
        <div class="container" style="margin-top:20px;">
            <div class="row">
                <div class="col-med-12">
                    <div class="page-header">
                        <h1>Mis tickets: <small>Selecciona el ticket del que desees ver mas informacion</small></h1>
                    </div>
                </div>
              <div class="col-med-12">
                <table id="knowledge" class="display cell-border stripe">
                  <thead>
                      <tr>
                          <th>Seleccionar</th>
                          <th>Fecha-hora</th>
                          <th>Pregunta</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($questions as $q)
                      <tr>
                        <td><label class="btn active">
                            {{ Form::radio('ticket', $q->id_ticket, false, ['id'=> $q->id_ticket, 'style'=>'display:none;']) }}<i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i>
                        </label></td>
                        <td>{{ $q->fecha_hora }}</td>
                        <td>{{ $q->pregunta }}</td>
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
                  },
                  bAutoWidth: false , 
                  aoColumns : [
                      { sWidth: '10%' },
                      { sWidth: '15%' },
                      { sWidth: '75%' },

                  ],
                  "order": [[ 1, "desc" ]]
                });
             $('input[type=radio][name=ticket]').change(function() {
                @foreach ($questions as $key => $q)
                @if($key==0)
                if (this.value == {{$q->id_ticket}}) {
                    alert({{$q->id_ticket}});
                    alert($('input:radio[name=ticket]:checked').val());
                }
                @else
                else if (this.value == {{$q->id_ticket}}) {
                    alert({{$q->id_ticket}});
                    alert($('input:radio[name=ticket]:checked').val());
                }
                @endif
                @endforeach
            });
            
            } );
        </script>
    @endsection