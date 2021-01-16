@extends('restrita.template')
@section('titulo', 'DASHBOARD')
@section('migalhas')
    <ol class="breadcrumb navbar-text navbar-right no-bg">
        <li class="current-parent">
            <a class="current-parent" href="{{route('dashboard')}}">
                <i class="fa fa-fw fa-home"></i>
            </a>
        </li>
        <li class="active">DASHBOARD</li>
    </ol>
@endsection
@section('conteudo')
    <!-- START 4 Boxes -->
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="panel panel-default b-a-0 bg-gray-dark">
                <div class="panel-heading bg-primary-i">
                    <div class="media">
                        <div class="media-body">
                            <span class="text-uppercsase">JOGOS REGISTRADOS</span>
                            <br>
                            <h1 class="display-4 m-t-0 m-b-0">570</h1>
                        </div>
                        <div class="media-right">
                            <p class="data-attributes m-b-0">
                                <span data-peity="{ &quot;fill&quot;: [&quot;#FFFFFF&quot;, &quot;#4ca8e1&quot;],  &quot;innerRadius&quot;: 20, &quot;radius&quot;: 28  }">100/100</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="panel-body p-t-3 p-b-0 text-center">
                    <div class="center-block">
                        <a href="{{route('jogo.index')}}">[+] DETALHES</a>
                    </div>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="panel panel-default b-a-0 bg-gray-dark">
                <div class="panel-heading bg-success-i">
                    <div class="media">
                        <div class="media-body">
                            <span class="text-uppercsase">EXCLUSIVOS</span>
                            <br>
                            <h1 class="display-4 m-t-0 m-b-0">68</h1>
                        </div>
                        <div class="media-right">
                            <p class="data-attributes m-b-0">
                                <span data-peity="{ &quot;fill&quot;: [&quot;#FFFFFF&quot;, &quot;#98be68&quot;],  &quot;innerRadius&quot;: 20, &quot;radius&quot;: 28  }">12/100</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="panel-body p-t-3 p-b-0 text-center">
                    <div class="center-block">
                        <a href="{{route('jogo.index')}}">[+] DETALHES</a>
                    </div>
                </div>
                <br>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="panel panel-default b-a-0 bg-gray-dark">
                <div class="panel-heading bg-warning-i">
                    <div class="media">
                        <div class="media-body">
                            <span class="text-uppercsase">MULTIPLATAFORMAS</span>
                            <br>
                            <h1 class="display-4 m-t-0 m-b-0">501</h1>
                        </div>
                        <div class="media-right">
                            <p class="data-attributes m-b-0">
                                <span data-peity="{ &quot;fill&quot;: [&quot;#FFFFFF&quot;, &quot;#ea825c&quot;], &quot;innerRadius&quot;: 20, &quot;radius&quot;: 28 }">88/100</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="panel-body p-t-3 p-b-0 text-center">
                    <div class="center-block">
                        <a href="{{route('jogo.index')}}">[+] DETALHES</a>
                    </div>
                </div>
                <br>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="panel panel-default b-a-0 bg-gray-dark">
                <div class="panel-heading bg-danger-i">
                    <div class="media">
                        <div class="media-body">
                            <span class="text-uppercsase">ÍNDICE DE COMPLETUDE</span>
                            <br>
                            <h1 class="display-4 m-t-0 m-b-0">99<small class="text-uppercase text-white">%</small></h1>
                        </div>
                        <div class="media-right">
                            <p class="data-attributes m-b-0">
                                <span data-peity="{ &quot;fill&quot;: [&quot;#FFFFFF&quot;, &quot;#d35b66&quot;], &quot;innerRadius&quot;: 20, &quot;radius&quot;: 28 }">99/100</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="panel-body p-t-3 p-b-0 text-center">
                    <div class="center-block">
                        <a href="{{route('jogo.index')}}">[+] DETALHES</a>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
    <!-- END 4 Boxes -->
    <div class="row">
        <div class="col-lg-4 m-t-2">
            <div class="panel panel-default no-bg b-a-2 b-gray-dark">
                <div class="panel-heading">JOGOS POR PLATAFORMA</div>
                <div class="panel-body">
                    <div class="jogos-por-plataforma"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="panel panel-default no-bg b-a-2 b-gray-dark">
                <div class="panel-heading">JOGOS POR PUBLISHER</div>
                <div class="panel-body">
                    <div class="jogos-por-publisher"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 m-t-2">
            <div class="panel panel-default no-bg b-a-2 b-gray-dark">
                <div class="panel-heading">EXCLUSIVOS X MULT</div>
                <div class="panel-body">
                    <div class="exclusivos-mults"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="panel panel-default no-bg b-a-2 b-gray-dark">
                <div class="panel-heading">JOGOS POR DIFICULDADE</div>
                <div class="panel-body">
                    <div class="jogos-por-dificuldade"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 m-t-2">
            <div class="panel panel-default no-bg b-a-2 b-gray-dark">
                <div class="panel-heading">ÚNCIOS X REPETIDOS</div>
                <div class="panel-body">
                    <div class="unicos-repetidos"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="panel panel-default no-bg b-a-2 b-gray-dark">
                <div class="panel-heading">JOGOS POR SITUAÇÃO</div>
                <div class="panel-body">
                    <div class="jogos-por-situacao"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="panel panel-default no-bg b-gray-dark b-a-2">
            <div class="panel-heading">PLATINAS POR MÊS</div>
            <div class="panel-body">
                <!-- START ROW -->
                <div class="row">
                    <!-- START Chart -->
                    <div class="col-lg-12">
                        <div class="platinas-por-mes m-t-1"></div>
                    </div>
                    <!-- END Chart -->
                </div>
                <!-- END ROW #1 -->
            </div>
        </div>
    </div>
@endsection
