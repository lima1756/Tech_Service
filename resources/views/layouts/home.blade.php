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
        
         @section('head')
    </head>
    <body>
        @section('header')
        @show
        <!--Navigation bar-->
        <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">Tech<span>-service</span></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
        @section('menu')
        @show
            </ul>
            </div>
        </div>
        </nav>
        @section('extra1')
        @show
         <!--Banner-->
        <div class="banner">
        <div class="bg-color">
            <div class="container">
            <div class="row">
                <div class="banner-text text-center">
                <div class="text-border">
                    <h2 class="text-dec">Velocidad & Confianza</h2>
                </div>
                <div class="intro-para text-center quote">
                    <p class="big-text"><b>Tech</b>-Service</p>
                    <p class="small-text">Tu parte de soporte para la "Empresa" <br>(El Psy-Congroo)</p>
                </div>
                <a href="#feature" class="mouse-hover"><div class="mouse"></div></a>
                </div>
            </div>
            </div>
        </div>
        </div>
        <!--/ Banner-->
        <!--Feature-->
        <section id ="feature" class="section-padding">
        <div class="container">
            <div class="row">
            <div class="header-section text-center">
                <h2>Funcionamiento</h2>
                <p>En Tech-service, estamos comprometidos por brindar el mejor servicio tecnico<br>  a distancia para la empresa.</p>
                <hr class="bottom-line">
            </div>
            <div class="feature-info">
                <div class="fea">
                <div class="col-md-4">
                    <div class="heading pull-right">
                    <h4>Primer paso</h4>
                    <p>Registrate y espera que alguno de nuestros trabajadores acepte tu solicitud, te sera enviado un correo</p>
                    </div>
                    <div class="fea-img pull-left">
                    <i class="fa fa-desktop"></i>
                    </div>
                </div>
                </div>
                <div class="fea">
                <div class="col-md-4">
                    <div class="heading pull-right">
                    <h4>Segundo paso</h4>
                    <p>Revisa el Knowledge para ver si tu pregunta no ha sido resuelta con anterioridad. Si no lo encuentras, genera tu ticket con tu problema</p>
                    </div>
                    <div class="fea-img pull-left">
                    <i class="fa fa-laptop"></i>
                    </div>
                </div>
                </div>
                <div class="fea">
                <div class="col-md-4">
                    <div class="heading pull-right">
                    <h4>Tercer paso</h4>
                    <p>Mantente atento a tu correo para recibir la información del estado de tu problema :)</p>
                    </div>
                    <div class="fea-img pull-left">
                    <i class="fa fa-mobile"></i>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </section>
        <!--/ feature-->
        @section('extra')
        @show
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
        
    </body>
</html>