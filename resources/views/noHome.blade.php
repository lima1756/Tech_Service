@extends('layouts.home')
@section('title', 'Welcome!')
<?php
  $type="0";
  if(null!==Auth::id()){
    $id=Auth::id();
    $type="null";
    $query=DB::table('mortals')->where('id_usuario', '=', $id)->first();
    if(count($query)>0){
      $type="mortal";
    }
    else{
      $query=DB::table('superusers')->where('id_usuario', '=', $id)->first();
      if(count($query)>0){
        $type="SU";
      }
    }
  }
?>

@if($type=="SU")
  @section('menu')
    <li><a href="dashboard">Dashboard</a></li>
    <li class="btn-trial"><a href="logOut">Cerrar Sesión</a></li>
  @endsection   

@elseif($type=="mortal")
  @section('menu')
    <li><a href="tickets">Tickets</a></li>
    <li><a href="knowledge">knowledge</a></li>
    <li class="btn-trial"><a href="logOut">Cerrar Sesión</a></li>
  @endsection   


@else

@section('head')
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Candal|Alegreya+Sans">
@endsection

@section('header')
    @if (isset($goTo))
    <script>
    window.onload = function() {
        window.location = "#{{$goTo}}"
    }
    </script>
    @endif
    
  @endsection
  
  @section('menu')
    
          <li><a href="#" data-target="#login" data-toggle="modal">Iniciar sesión</a></li>
          <li class="btn-trial"><a href="#registro">Registrate</a></li>
  @endsection        
  @section('extra1')
  <?php $items = DB::select('SELECT id, name FROM countries ORDER BY name ASC;'); ?>
    <!--/ Navigation bar-->
    <!--Modal box-->
    @if ($type=="null")
      <script>
        window.onload = function() {
            window.location = "#login";   
            $('#login').modal('show');
            var errorDiv2 = document.getElementById('errorlogIn');
            document.getElementById('errorlogIn').style.visibility = "visible";
            document.getElementById('errorlogIn').style.display = "block";
            errorDiv2.innerHTML=errorDiv2.innerHTML+"Los datos de inicio son erroneos";
        }
    </script>
    @else
    
    @endif
    <div class="modal fade" id="login" role="dialog">
      <div class="modal-dialog modal-sm">
      
        <!-- Modal content no 1-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title text-center form-title">Inicio de seción</h4>
          </div>
          <div class="modal-body padtrbl">

            <div class="login-box-body">
            <div id="errorlogIn" class="alert alert-danger" style="visibility:hidden;display: none;"></div>
              <div class="form-group">
                <form name="logIn" id="loginForm" action="logIn" method="post">
                  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                 <div class="form-group has-feedback"> <!----- username -------------->
                      <input class="form-control" placeholder="Email"  id="email" type="email" name="email"/> 
            <span style="display:none;font-weight:bold; position:absolute;color: red;position: absolute;padding:4px;font-size: 11px;background-color:rgba(128, 128, 128, 0.26);z-index: 17;  right: 27px; top: 5px;" id="span_loginid"></span><!---Alredy exists  ! -->
                      <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  </div>
                  <div class="form-group has-feedback"><!----- password -------------->
                      <input class="form-control" placeholder="Contraseña" id="pass" type="password" name="pass"/>
            <span style="display:none;font-weight:bold; position:absolute;color: grey;position: absolute;padding:4px;font-size: 11px;background-color:rgba(128, 128, 128, 0.26);z-index: 17;  right: 27px; top: 5px;" id="span_loginpsw"></span><!---Alredy exists  ! -->
                      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                  </div>
                  <div class="row">
                      <div class="col-xs-12">
                          <div class="checkbox icheck">
                              <label>
                                <input type="checkbox" id="loginrem" name="loginrem"> Remember Me
                              </label>
                          </div>
                      </div>
                      <div class="col-xs-12">
                          <button type="submit" class="btn btn-green btn-block btn-flat">Sign In</button>
                      </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <!--/ Modal box-->
    
    @endsection
   
    @section('extra')
    <!--registro-->
    <section id ="registro" class="section-padding">
      <div class="container">
        <div class="row">
          <div class="header-section text-center">
            <h2>Registrate</h2>
            <p>Esta herramienta tiene la intención de disminuir costos, simplificar tareas y permitir una mayor eficiencia de trabajo para todos. <br>¿Que esperas para registrarte?</p>
            <hr class="bottom-line">
          </div>
          <div id="error" class="alert alert-danger" style="visibility:hidden;display: none;"></div>
          <div id="registered" class="alert alert-success" style="visibility:hidden; display: none;"></div>
          <?php if(isset($error)){
            if(count($error)>0){
              echo '<script type="text/javascript">
                          var errorDiv = document.getElementById(\'error\');
                          document.getElementById(\'error\').style.visibility = "visible";
                          document.getElementById(\'error\').style.display = "block";
                        </script>';        
              foreach($error as $e)
                if($e=="NULLS"){
                  echo '<script type="text/javascript">
                        errorDiv.innerHTML=errorDiv.innerHTML+"Porfavor llene todos los formularios<br>";
                        </script>';
                }
                elseif($e=="denied"){
                  echo '<script type="text/javascript">
                          errorDiv.innerHTML=errorDiv.innerHTML+"Su solicitud ya fue previamente denegada<br>";
                        </script>';
                }
                elseif($e=="registered"){
                  echo '<script type="text/javascript">
                          errorDiv.innerHTML=errorDiv.innerHTML+"Su usuario esta en proceso de aceptación<br>";
                        </script>';
                }
                elseif($e=="passwords"){
                  echo '<script type="text/javascript">
                          errorDiv.innerHTML=errorDiv.innerHTML+"Porfavor revise que las contraseñas sean iguales<br>";
                        </script>';
                }
            }
            elseif(count($error)==0){
              echo '<script type="text/javascript">
                          var registered = document.getElementById(\'registered\');
                          registered.style.visibility = "visible";
                          registered.style.display = "block";
                          registered.innerHTML="Su registro a sido guardado, espere la confirmación en su correo!";
                        </script>';   
            }
          }
          ?>
          
          <form action="/signUp" method="post" role="form" class="contactForm">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
              <div class="col-md-6 col-sm-6 col-xs-12 left">
                <div class="form-group">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Tu Email" minlength=5/>
                    <div class="validation"></div>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="pass" id="pass" placeholder="Tu contraseña" minlength=6/>
                    <div class="validation"></div>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="pass2" id="pass" placeholder="Confirmar contraseña" data-rule="password" minlength=6/>
                    <div class="validation"></div>
                </div>
                <div class="form-group">
                    <input type="text" name="name" class="form-control form" id="name" placeholder="Tu nombre" minlength=2  />
                    <div class="validation"></div>
                </div>
                <div class="form-group">
                    <input type="text" name="last" class="form-control form" id="last" placeholder="Tu apellido" minlength=2 />
                    <div class="validation"></div>
                </div>
                <div class="form-group">
                    <input type="number" name="cell" class="form-control form" id="last" placeholder="Tu celular" min=10000  />
                    <div class="validation"></div>
                </div>
                
              </div>
              
              <div class="col-md-6 col-sm-6 col-xs-12 right">
                <div class="form-group">
                    <input type="number" name="tel" class="form-control form" id="last" placeholder="Tu telefono" minlength=10000  />
                    <div class="validation"></div>
                </div>
                <div class="form-group">
                    <input type="number" name="ext" class="form-control form" id="last" placeholder="Tu extensión" minlength=1 />
                    <div class="validation"></div>
                </div>
                <div class="form-group">
                    <input type="text" name="area" class="form-control form" id="last" placeholder="Tu area de trabajo" minlength=2 />
                    <div class="validation"></div>
                </div>
                <div class="form-group">
                    <input type="text" name="work" class="form-control form" id="last" placeholder="Tu trabajo" minlength=2 />
                    <div class="validation"></div>
                </div>
                
                <div class="form-group">
                    <select class="form-control" name="country" id="country">
                            <option value="null">Seleccione su país</option>
                        @foreach ($items as $item)
                            <option value='<?php echo $item->id ?>'><?php echo $item->name ?></option>
                        @endforeach
                    </select>
                </div>
              </div>
              
              <div class="col-xs-12" style="text-align:center">
                <!-- Button -->
                <button type="submit" id="submit" name="submit" class="form btn btn-xl contact-form-button light-form-button" value="ok" >Registrarme</button>
              </div>
          </form>
          
        </div>
      </div>
    </section>
    <!--/ registro-->
    

    

@endsection


  

@endif