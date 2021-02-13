<!DOCTYPE html>
<html lang="pt-BR">
<!-- START Head -->
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <!-- Enable responsiveness on mobile devices-->
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>
        CONTROLE DE PLATINA | CATÁLOGO
    </title>
    <!--START Loader -->
    <style>
        #initial-loader{display:flex;align-items:center;justify-content:center;flex-wrap:wrap;width:100%;background:#212121;position:fixed;z-index:10000;top:0;left:0;bottom:0;right:0;transition:opacity .2s ease-out}#initial-loader .initial-loader-top{display:flex;align-items:center;justify-content:space-between;width:200px;border-bottom:1px solid #2d2d2d;padding-bottom:5px}#initial-loader .initial-loader-top > *{display:block;flex-shrink:0;flex-grow:0}#initial-loader .initial-loader-bottom{padding-top:10px;color:#5C5C5C;font-family:-apple-system,"Helvetica Neue",Helvetica,"Segoe UI",Arial,sans-serif;font-size:12px}@keyframes spin{100%{transform:rotate(360deg)}}#initial-loader .loader g{transform-origin:50% 50%;animation:spin .5s linear infinite}body.loading {overflow: hidden !important} body.loaded #initial-loader{opacity:0}
    </style>
    <!--END Loader-->
    <!-- SCSS Output -->
    <link rel="stylesheet" href="{{asset('assets/stylesheets/app.min.e0bb64e7.css?v=').uniqid()}}">
    <!-- START Favicon -->
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('img/logo1.png')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- END Favicon -->
    <!-- RSS -->
    <link rel="alternate" type="application/rss+xml" title="RSS" href="../atom.xml">
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
<body class="loading">
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
    <nav class="navigation">
        <!-- START Navbar -->
        <div class="navbar-inverse navbar navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header text-medium">
                    <a href="/" style="padding-top: 30px;">CONTROLDE PLATINA - SEJA BEM VINDO</a>
                </div>
                <div class="collapse navbar-collapse" id="navbar">
                    <!-- START Right Side Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="{{route('formLogin')}}" class="btn btn-primary">LOGIN <i class="fa fa-lg fa-sign-in" title="Login"></i></a>
                        </li>
                    </ul>
                    <!-- END Right Side Navbar -->
                </div>
            </div>
        </div>
        <!-- END Navbar -->
    </nav>
    <div class="content">
        <div class="sub-navbar sub-navbar__header-breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 sub-navbar-column">

                    </div>
                </div>
            </div>
        </div>
        <!-- END Sub-Navbar with Header and Breadcrumbs-->
        <div class="container">
            <!-- START EDIT CONTENT -->
            <div class="row">
                <div class="col-md-12 text-right">
                    <form class="form-inline" method="get" action="{{route('publica')}}" name="filtro" enctype="application/x-www-form-urlencoded">
                        <input type="hidden" name="pesquisa" value="true">
                        <div class="form-group">
                            <a href="{{route('formLogin')}}" class="btn btn-primary"><i class="fa fa-lg fa-sign-in" title="Login"></i></a>
                        </div>&nbsp;
                        <div class="form-group">
                            <a href="{{route('publica')}}" class="btn btn-eminence"><i class="fa fa-lg fa-home" title="Resetar pesquisa"></i></a>
                        </div>&nbsp;
                        <div class="form-group">
                            <input type="search" name="titulo" class="form-control" placeholder="Buscar vídeo..." value="{{isset($_GET['titulo'])?$_GET['titulo']:''}}" autofocus>
                        </div>&nbsp;
                        <div class="form-group">
                            <select name="categoria" id="single" class="form-control select2 select2-input">
                                <option value="">CATEGORIA</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{$categoria}}"{{(isset($_GET['categoria']) and $categoria == $_GET['categoria'])?' selected':''}}>{{$categoria}}</option>
                                @endforeach
                            </select>
                        </div>&nbsp;
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <br><br>
            <div class="row">
                    @foreach($videos as $video)
                    <div class="col-md-4">
                        <iframe width="392" height="220" src="{{$video->url}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    @if(isset($_GET['pesquisa']))
                        {{ $videos->appends($_GET)->links() }}
                    @else
                        {{ $videos->links() }}
                    @endif
                </div>
            </div>
            <!-- END EDIT CONTENT -->
        </div>
    </div>
    <!-- START Footer -->
    <p style="margin-left: 10px; padding-top: 10px;">
        <strong class="m-r-1">CATÁLOGO DE JOGOS</strong>
        <span>&#xA9; {{date('Y')}}. By CONTROLE DE PLATINA</span>
    </p>
    <!-- END Footer -->
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
        $(document).ready(function() {
            @if (session('mensagem'))
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
            @if(Route::current()->getName()=='galeria')
            $('#printModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var titulo = button.data('titulo') // Extract info from data-* attributes
                var print = button.data('print') // Extract info from data-* attributes
                var descricao = button.data('descricao') // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('#titulo').html(titulo);
                modal.find('#print').attr('src', print);
                modal.find('#descricao').html(descricao);
            })
            @endif
            @if(Route::current()->getName()=='jogo.index')
            $('#modalJjogoDelete').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var jogoId = button.data('jogo-id') // Extract info from data-* attributes
                var mensagem = button.data('mensagem') // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('#mensagem').html(mensagem);
                modal.find('#btnJogoDelete').attr('href', 'http://controledeplatina.com.br/restrita/jogo/'+jogoId+'/delete');
            })
            @endif
                window.onload = function() {
                MaskedInput({
                    elm: document.getElementById('platinado_em'),
                    format: '__/__/____',
                    separator: '/'
                });
            };
            Dashboard.Helpers.elementExists('#daterangepicker-container', function() {
                $('.date').daterangepicker({
                    autoUpdateInput: false,
                    singleDatePicker: true,
                    showDropdowns: true,
                    locale: {
                        format: 'DD/MM/YYYY',
                        "daysOfWeek": [
                            "Dom",
                            "Seg",
                            "Ter",
                            "Qua",
                            "Qui",
                            "Sex",
                            "Sab"
                        ],
                        "monthNames": [
                            "Janeiro",
                            "Feveiro",
                            "Março",
                            "Abril",
                            "Maio",
                            "Junho",
                            "Julho",
                            "Agosto",
                            "Setembro",
                            "Outubro",
                            "Novembro",
                            "Dezembro"
                        ],
                    },
                }, function(chosen_date) {
                    $('.date').val(chosen_date.format('DD/MM/YYYY'));
                });
            });
        });
    })();
</script>
<link rel="stylesheet" href="{{asset('assets/vendor/css/lib.min.css')}}">
<script src="{{asset('assets/vendor/js/highstock.min.js')}}"></script>
<script src="{{asset('assets/javascript/highchart-themes/highcharts&highstock-theme.js')}}"></script>
@if(Route::currentRouteName() == 'dashboard')
    @include('restrita.graficos')
@endif
<script src="{{asset('assets/javascript/inputmask.js')}}"></script>
<script src="{{asset('assets/javascript/peity-settings.js')}}"></script>
<script src="{{asset('assets/vendor/js/toastr.min.js')}}"></script>
<script src="{{asset('assets/vendor/js/select2.min.js')}}"></script>
<script src="{{asset('assets/vendor/js/moment.min.js')}}"></script>
<script src="{{asset('assets/vendor/js/daterangepicker.min.js')}}"></script>
<script src="{{asset('assets/vendor/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('assets/javascript/app.min.13a3a368.js')}}"></script>
<script src="{{asset('assets/javascript/plugins-init.js')}}"></script>
<script src="{{asset('assets/javascript/switchery-settings.js')}}"></script>
</body>
</html>
