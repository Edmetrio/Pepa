<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pepa</title>
    <link rel="icon" href="{{asset('assets/images/logo/logos.png')}}">    
    {{-- <link rel="stylesheet" href="{{asset('assets/css/vendor/bootstrap.min.css')}}"> --}}
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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    
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
                     <div class="header-logo d-flex align-items-center">
                        <a href="{{url('/')}}">
                             <img class="img-full" src="{{asset('assets/images/logo/icons.png')}}" alt="Logo">
                        </a>
                    </div>
            </div>
        </div>
    </div>

    {{$slot}}

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