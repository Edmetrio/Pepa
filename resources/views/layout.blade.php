<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pepa</title>

    <link rel="stylesheet" href="{{asset('assets/css/vendor/bootstrap.min.css')}}">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="{{asset('assets/css/vendor/font.awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('assets/css/vendor/ionicons.min.css')}}">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/slick.min.css')}}">
    <!-- Animation -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/animate.min.css')}}">
    <!-- jQuery Ui -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/jquery-ui.min.css')}}">
    <!-- Nice Select -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/nice-select.min.css')}}">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet"> --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="cfdeaedf-c027-401c-8d4a-6ab736ab30f2" data-blockingmode="auto" type="text/javascript"></script>
    <script id="CookieDeclaration" src="https://consent.cookiebot.com/cfdeaedf-c027-401c-8d4a-6ab736ab30f2/cd.js" type="text/javascript" async></script>

    <style>
        .box-cookies.hide {
            display: none !important;
        }
        
        .box-cookies {
            position: fixed;
            background: #fff;
            width: 90%;
            z-index: 998;
            bottom: 10px;
            left: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-radius: 10px;
            box-shadow: #026839 5px 5px 5px;
        }
        
        .box-cookies .msg-cookies,
        .box-cookies .btn-cookies {
            text-align: center;
            padding-top: 10px;
            padding-left: 10px;
            padding-right: 5px;
            color: #333;
            font-size: 18px;
            font-weight: 600;
        }
        
        .box-cookies .btn-cookies {
            background: #026839;
            cursor: pointer;
            align-self: normal;
            border-radius: 5px;
            color: #fff;
        }
        
        @media screen and (max-width: 600px) {
            .box-cookies {
                flex-direction: column;
            }
        }
    </style>
@livewireStyles
</head>

<body>
<div class="box-cookies hide">
        <p class="msg-cookies">Este site usa cookies para garantir que você obtenha a melhor experiência. <a href="{{url('politica')}}">Política de Privacidade</a> </p>
        <div class="btn-cookies"> Aceitar!</div>
        <script>
        if (!localStorage.nomeDoSeuCookies) {
            document.querySelector(".box-cookies").classList.remove('hide');
        }

        const acceptCookies = () => {
            document.querySelector(".box-cookies").classList.add('hide');
            localStorage.setItem("nomeDoSeuCookies", "accept");
        };

        const btnCookies = document.querySelector(".btn-cookies");

        btnCookies.addEventListener('click', acceptCookies);
    </script>
    </div>

    <div class="main-header">
        <div class="container container-default custom-area">
            <div class="row">
                <div class="col-lg-12 col-custom">
                    <div class="row align-items-center">
                        <div class="col-lg-2 col-xl-2 col-sm-6 col-6 col-custom">
                            <div class="header-logo d-flex align-items-center">
                                <a href="{{url('/')}}">
                                    <img class="img-full" src="{{asset('assets/images/logo/icons.png')}}" alt="First Tech">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @yield('content')

<footer class="footer-area">
    <div class="footer-widget-area">
        <div class="container container-default custom-area">
            
        </div>
    </div>
</footer>

</div>


<aside class="off-canvas-wrapper" id="mobileMenu">
    <div class="off-canvas-overlay"></div>
    <div class="off-canvas-inner-content">
        <div class="btn-close-off-canvas">
            <i class="fa fa-times"></i>
        </div>
        <div class="off-canvas-inner">

            <div class="search-box-offcanvas">
                <form>
                    <input type="text" placeholder="Procurar Produto...">
                    <button class="search-btn"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <!-- mobile menu start -->
            <div class="mobile-navigation">

                <!-- mobile menu navigation start -->
                <nav>
                    <ul class="mobile-menu">
                        <li class="menu-item-has-children"><a href="{{url('/')}}">Inicio</a></li>
                        <li class="menu-item-has-children "><a href="{{url('categoria')}}">Categorias</a>
                           {{--  <ul class="dropdown">
                                @foreach($categoria as $c)
                                <li><a href="{{"produto/$c->id"}}">{{$c->nome}}</a></li>
                                @endforeach
                            </ul> --}}
                        </li>
                        <li class="menu-item-has-children"><a href="">Todos Produtos</a>
                        </li>
                        <li><a href="#">Sobre Nos</a></li>
                        <li><a href="{{url('contacto')}}">Contactos</a></li>
                    </ul>
                </nav>
                <!-- mobile menu navigation end -->
            </div>
            <!-- mobile menu end -->
            <div class="header-top-settings offcanvas-curreny-lang-support">
                <!-- mobile menu navigation start -->
                <nav>
                    <ul class="mobile-menu">
                        <li class="menu-item-has-children"><a href="#">Minha Conta</a>
                            <ul class="dropdown">
                                <!-- <li><a href="#">Entrar</a></li>
                                <li><a href="#">Registrar</a></li> -->
                                @if (Route::has('login'))
                                @auth
                                <span>
                                    <div>{{ Auth::user()->name }}</div>
                                </span>
                                <span><a href="{{url('conta')}}"><i class="ion-android-person" style="padding: 10px;"></i>Perfil</a></span>
                                <span><a href="{{url('historico')}}"><i class="ion-clipboard" style="padding: 10px;"></i>Histórico de Compras</a></span>
                                <span><a href="#"><i class="ion-android-exit" style="padding: 10px;"></i>Alterar Palavra-Passe</a></span>
                                <span>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <i class="ion-android-lock" style="padding: 10px;"></i>
                                        <button type="submit" value="">Terminar Sessão</button>
                                    </form>
                                </span>
                                @else
                                <li><a href="{{ route('login') }}">Entrar</a></li>
                                <li><a href="{{ route('register') }}">Registrar</a></li>
                                <!-- <li>
                                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Entrar</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Registrar</a>
                                    </li> -->
                                @endauth
                                @endif
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- mobile menu navigation end -->
            </div>
            <!-- offcanvas widget area start -->
            <div class="offcanvas-widget-area">
                <div class="top-info-wrap text-left text-black">
                    <ul>
                        <li>
                            <i class="fa fa-phone"></i>
                            <a href="info%40yourdomain.html">(+258) 84 000 0000</a>
                        </li>
                        <li>
                            <i class="fa fa-envelope"></i>
                            <a href="info%40yourdomain.html">info@firsteducation.edu.mz</a>
                        </li>
                    </ul>
                </div>
                <div class="off-canvas-widget-social">
                    <a title="Facebook-f" href="#"><i class="fa fa-facebook-f"></i></a>
                    <a title="Twitter" href="#"><i class="fa fa-twitter"></i></a>
                    <a title="Linkedin" href="#"><i class="fa fa-linkedin"></i></a>
                    <a title="Youtube" href="#"><i class="fa fa-youtube"></i></a>
                    <a title="Vimeo" href="#"><i class="fa fa-vimeo"></i></a>
                </div>
            </div>
            <!-- offcanvas widget area end -->
        </div>
    </div>
</aside>
<!-- Scroll to Top Start -->
<a class="scroll-to-top" href="#">
    <i class="ion-chevron-up"></i>
</a>
<!-- Scroll to Top End -->

<!-- jQuery JS -->
<script src="{{asset('assets/js/vendor/jquery-3.5.1.min.js')}}"></script>
<!-- jQuery Migrate JS -->
<script src="{{asset('assets/js/vendor/jQuery-migrate-3.3.0.min.js')}}"></script>
<!-- Modernizer JS -->
<script src="{{asset('assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>
<!-- Bootstrap JS -->
<script src="{{asset('assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
<!-- Slick Slider JS -->
<script src="{{asset('assets/js/plugins/slick.min.js')}}"></script>
<!-- Countdown JS -->
<script src="{{asset('assets/js/plugins/jquery.countdown.min.js')}}"></script>
<!-- Ajax JS -->
<script src="{{asset('assets/js/plugins/jquery.ajaxchimp.min.js')}}"></script>
<!-- Jquery Nice Select JS -->
<script src="{{asset('assets/js/plugins/jquery.nice-select.min.js')}}"></script>
<!-- Jquery Ui JS -->
<script src="{{asset('assets/js/plugins/jquery-ui.min.js')}}"></script>
<!-- jquery magnific popup js -->
<script src="{{asset('assets/js/plugins/jquery.magnific-popup.min.js')}}"></script>

<!-- Main JS -->
<script src="{{asset('assets/js/main.js')}}"></script>

<script>
  
    window.addEventListener('swal:modal', event => { 
        swal({
          title: event.detail.message,
          text: event.detail.text,
          icon: event.detail.type,
        });
    });
      
    window.addEventListener('swal:confirm', event => { 
        swal({
          title: event.detail.message,
          text: event.detail.text,
          icon: event.detail.type,
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            window.livewire.emit('remove');
          }
        });
    });
     </script>
@livewireScripts
</body>

</html>