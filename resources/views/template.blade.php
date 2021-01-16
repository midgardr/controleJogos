<!DOCTYPE html>
<html lang="pt-BR">
<!-- START Head -->
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <!-- Enable responsiveness on mobile devices-->
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>
        CONTROLE DE PLATINA | CATÁLOGO DE JOGOS
    </title>
    <!--START Loader -->
    <style>
        #initial-loader{display:flex;align-items:center;justify-content:center;flex-wrap:wrap;width:100%;background:#212121;position:fixed;z-index:10000;top:0;left:0;bottom:0;right:0;transition:opacity .2s ease-out}#initial-loader .initial-loader-top{display:flex;align-items:center;justify-content:space-between;width:200px;border-bottom:1px solid #2d2d2d;padding-bottom:5px}#initial-loader .initial-loader-top > *{display:block;flex-shrink:0;flex-grow:0}#initial-loader .initial-loader-bottom{padding-top:10px;color:#5C5C5C;font-family:-apple-system,"Helvetica Neue",Helvetica,"Segoe UI",Arial,sans-serif;font-size:12px}@keyframes spin{100%{transform:rotate(360deg)}}#initial-loader .loader g{transform-origin:50% 50%;animation:spin .5s linear infinite}body.loading {overflow: hidden !important} body.loaded #initial-loader{opacity:0}
    </style>
    <!--END Loader-->
    <!-- SCSS Output -->
    <link rel="stylesheet" href="{{asset('assets/stylesheets/app.min.e0bb64e7.css')}}">
    <!-- START Favicon -->
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('img/logo1.png')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- END Favicon -->
    <!-- Google Analytics -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-83862026-1', 'auto');
        ga('send', 'pageview');
    </script>
    <!-- jekyll settings -->
    <script>
        var ASSET_PATH_BASE = '../';
    </script>
</head>
<!-- END Head -->
<body class="sidebar-disabled navbar-disabled footer-disabled loading">
<div id="initial-loader">
    <div>
        <div class="initial-loader-top">
            <img class="initial-loader-logo img-responsive" src="{{asset('img/logo4.png')}}" alt="Loader">
            <div class="loader loader--style1">
                <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="30px" height="30px" viewbox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
                    <g>
                        <path fill="#2d2d2d" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z">
                            <path fill="#2c97de" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0C22.32,8.481,24.301,9.057,26.013,10.047z">
                    </g>
                </svg>
            </div>
        </div>
        <div class="initial-loader-bottom">
            Carregando. Por favor, aguarde. <i class="fa fa-cricle" style="opacity: 0"></i>
        </div>
    </div>
</div>
<!-- Bower Libraries Scripts -->
<script src="{{asset('assets/vendor/js/lib.min.js')}}"></script>
<div class="main-wrap">
    <div class="content">
        <div class="container-fluid">
            <br>
            @yield('conteudo')
        </div>
    </div>
</div>
<script>
    // Hide loader
    (function() {
        var bodyElement = document.querySelector('body');
        bodyElement.classList.add('loading');

        document.addEventListener('readystatechange', function() {
            if(document.readyState === 'complete') {
                var bodyElement = document.querySelector('body');
                var loaderElement = document.querySelector('#initial-loader');

                bodyElement.classList.add('loaded');
                setTimeout(function() {
                    bodyElement.removeChild(loaderElement);
                    bodyElement.classList.remove('loading', 'loaded');
                }, 200);
            }
        });
    })();
    $(document).ready(function() {
        @if (session()->has('mensagem'))
        function notificacao() {
            toastr["{{ session("tipo") }}"]("{{ session("mensagem") }}", "{{ session("titulo") }}")
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        }
        notificacao();
        @endif
    });
</script>
<!-- Bower Libraries Styles -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/lib.min.css')}}">
<script src="{{asset('assets/vendor/js/toastr.min.js')}}"></script>
<script src="{{asset('assets/javascript/toastr-settings.js')}}"></script>
<script src="{{asset('assets/javascript/app.min.13a3a368.js')}}"></script>
<script src="{{asset('assets/javascript/plugins-init.js')}}"></script>
<script src="{{asset('assets/javascript/switchery-settings.js')}}"></script>
</body>
</html>
