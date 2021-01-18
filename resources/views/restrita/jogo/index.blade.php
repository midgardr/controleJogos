@extends('restrita.template')
@section('titulo', 'DASHBOARD')
@section('migalhas')
    <ol class="breadcrumb navbar-text navbar-right no-bg">
        <li class="current-parent">
            <a class="current-parent" href="{{route('dashboard')}}">
                <i class="fa fa-fw fa-pie-chart"></i>
            </a>
        </li>
        <li>
            <a href="{{route('dashboard')}}">DASHBOARD</a>
        </li>
        <li class="active">
            <i class="fa fa-fw fa-gamepad"></i> MEUS JOGOS
        </li>
        <li>
            <i class="fa fa-fw fa-file-image-o"></i> <a href="{{route('galeria')}}">GALERIA DE PRINTS</a>
        </li>
    </ol>
@endsection
@section('conteudo')
    <div class="col-lg-2">
        <div class="row">
            <div class="col-lg-12 col-md-6 col-sm-6 col-xs-6">
                <!-- START Widget - Menu Pills Vertical -->
                <ul class="nav nav-pills nav-stacked m-b-2">
                    <li role="presentation"{{empty($_GET)?' class=active':''}}><a href="{{route('jogo.index')}}">Todos os jogos <span class="badge pull-right">{{$metricas['todosJogos']}}</span> </a></li>
                    <li role="presentation"{{isset($_GET['jogando'])?' class=active':''}}><a href="{{route('jogo.index', 'pesquisa=true&jogando=true')}}">Jogando <span class="badge pull-right">{{$metricas['jogando']}}</span> </a></li>
                    <li role="presentation"{{isset($_GET['platinados'])?' class=active':''}}><a href="{{route('jogo.index', 'pesquisa=true&platinados=true')}}">Platinados <span class="badge pull-right">{{$metricas['platinados']}}</span> </a></li>
                    <li role="presentation"{{isset($_GET['naoPlatinados'])?' class=active':''}}><a href="{{route('jogo.index', 'pesquisa=true&naoPlatinados=true')}}">Não platinados <span class="badge pull-right">{{$metricas['naoPlatinados']}}</span> </a></li>
                    <li role="presentation"{{isset($_GET['exclusivos'])?' class=active':''}}><a href="{{route('jogo.index', 'pesquisa=true&exclusivos=true')}}">Exclusivos <span class="badge pull-right">{{$metricas['exclusivos']}}</span> </a></li>
                    <li role="presentation"{{isset($_GET['multipltaformas'])?' class=active':''}}><a href="{{route('jogo.index', 'pesquisa=true&multipltaformas=true')}}">Multis <span class="badge pull-right">{{$metricas['multiplataformas']}}</span> </a></li>
                    <li role="presentation"{{isset($_GET['ineditos'])?' class=active':''}}><a href="{{route('jogo.index', 'pesquisa=true&ineditos=true')}}">Inéditos <span class="badge pull-right">{{$metricas['ineditos']}}</span> </a></li>
                    <li role="presentation"{{isset($_GET['repetidos'])?' class=active':''}}><a href="{{route('jogo.index', 'pesquisa=true&repetidos=true')}}">Repetidos <span class="badge pull-right">{{$metricas['repetidos']}}</span> </a></li>
                    <li role="presentation"{{isset($_GET['naoLancados'])?' class=active':''}}><a href="{{route('jogo.index', 'pesquisa=true&naoLancados=true')}}">Não lançados <span class="badge pull-right">{{$metricas['naoLancados']}}</span> </a></li>
                    <li role="presentation"{{isset($_GET['desistidos'])?' class=active':''}}><a href="{{route('jogo.index', 'pesquisa=true&desistidos=true')}}">Desistidos <span class="badge pull-right">{{$metricas['desistidos']}}</span> </a></li>
                    <li role="presentation"{{isset($_GET['naoGapras'])?' class=active':''}}><a href="{{route('jogo.index', 'pesquisa=true&naoGarapas=true')}}">Sem garapas <span class="badge pull-right">{{$metricas['naoGarapas']}}</span> </a></li>
                    <li role="presentation"{{isset($_GET['somenteGuia'])?' class=active':''}}><a href="{{route('jogo.index', 'pesquisa=true&somenteGuia=true')}}">Com guia <span class="badge pull-right">{{$metricas['somenteGuia']}}</span> </a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-10">
        <div class="row">
            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                <form class="form-inline" method="get" action="{{route('jogo.index')}}" name="filtro" enctype="application/x-www-form-urlencoded">
                    <input type="hidden" name="pesquisa" value="true">
                    <div class="form-group">
                        <input type="search" name="titulo" class="form-control" placeholder="Buscar jogo..." value="{{isset($_GET['titulo'])?$_GET['titulo']:''}}" autofocus>
                    </div>
                    <div class="form-group">
                        <select name="plataforma" id="single" class="form-control select2 select2-input">
                            <option value="">Plataforma</option>
                            @foreach($plataformas as $plataforma)
                                <option value="{{$plataforma}}"{{(isset($_GET['plataforma']) and $plataforma == $_GET['plataforma'])?' selected':''}}>{{$plataforma}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="publisher" id="single" class="form-control select2 select2-input">
                            <option value="">Publisher</option>
                            @foreach($publishers as $publisher)
                                <option value="{{$publisher}}"{{(isset($_GET['publisher']) and $publisher == $_GET['publisher'])?' selected':''}}>{{$publisher}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="dificuldade" id="single" class="form-control select2 select2-input">
                            <option value="">Dificuldade</option>
                            @foreach($dificuldades as $dificuldade)
                                <option value="{{$dificuldade}}"{{(isset($_GET['dificuldade']) and $dificuldade == $_GET['dificuldade'])?' selected':''}}>{{$dificuldade}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="situacao" id="single" class="form-control select2 select2-input">
                            <option value="">Situação</option>
                            @foreach($situacoes as $situacao)
                                <option value="{{$situacao}}"{{(isset($_GET['situacao']) and $situacao == $_GET['situacao'])?' selected':''}}>{{$situacao}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-search"></i></button>
                </form>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 pull-right">
                <a href="{{route('jogo.create')}}" class="btn btn-info"><i class="fa fa-fw fa-plus"></i></a>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="col-lg-10">
        <table class="table table-hover table-bordered table-striped">
            <thead>
            <tr>
                <th class="small text-muted text-uppercase"><strong>Título</strong></th>
                <th class="small text-muted text-uppercase text-center"><strong>Plataforma</strong></th>
                <th class="small text-muted text-uppercase"><strong>Publisher</strong></th>
                <th class="small text-muted text-uppercase"><strong>Dificuldade</strong></th>
                <th class="small text-muted text-uppercase"><strong>Situação</strong></th>
                <th class="small text-muted text-uppercase text-center"><strong>Exclusivo</strong></th>
                <th class="small text-muted text-uppercase text-center"><strong>Repetido</strong></th>
                <th class="small text-muted text-uppercase text-center"><strong>Platinado em</strong></th>
                <th class="small text-muted text-uppercase text-right"><strong>Ações</strong></th>
            </tr>
            </thead>
            <tbody>
                @forelse($jogos as $jogo)
                    <tr>
                        <td class="v-a-m">
                            <h5 class="m-b-0"><span>{{$jogo->titulo}}</span></h5>
                        </td>
                        <td class="v-a-m">
                            <h5 class="m-b-0 text-center"><span>{{$jogo->plataforma}}</span></h5>
                        </td>
                        <td class="v-a-m">
                            <h5 class="m-b-0"><span>{{$jogo->publisher}}</span></h5>
                        </td>
                        <td class="v-a-m">
                            <h5 class="m-b-0"><span>{{$jogo->dificuldade}}</span></h5>
                        </td>
                        <td class="v-a-m">
                            <h5 class="m-b-0"><span>{{$jogo->situacao}}</span></h5>
                        </td>
                        <td class="v-a-m">
                            <h5 class="m-b-0 text-center"><span>{{$jogo->exclusivo==1?'Sim':'Não'}}</span></h5>
                        </td>
                        <td class="v-a-m text-center">
                            <h5 class="m-b-0"><span>{{$jogo->repetido==1?'Sim':'Não'}}</span></h5>
                        </td>
                        <td class="v-a-m text-center">
                            <h5 class="m-b-0"><span>{{!empty($jogo->platinado_em)?$jogo->platinado_em:'Não platinado ainda :('}}</span></h5>
                        </td>
                        <td class="text-right v-a-m">
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="fa fa-bars m-r-1"></i> <span class="caret"></span> </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('jogo.edit', $jogo)}}"><i class="fa fa-fw text-gray-lighter fa-pencil m-r-1"></i> Editar</a></li>
                                    @if(!empty($jogo->guia1))
                                        <li role="separator" class="divider"></li>
                                        <li><a href="{{$jogo->guia1}}" target="_blank"><i class="fa fa-fw text-gray-lighter fa-link m-r-1"></i> Guia 1</a></li>
                                    @endif
                                    @if(!empty($jogo->guia2))
                                        <li role="separator" class="divider"></li>
                                        <li><a href="{{$jogo->guia2}}" target="_blank"><i class="fa fa-fw text-gray-lighter fa-link m-r-1"></i> Guia 2</a></li>
                                    @endif
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#" data-toggle="modal" data-target="#modalJjogoDelete" data-jogo-id="{{$jogo->id}}" data-mensagem="Deseja realmente excluir o jogo {{$jogo->titulo}}"><i class="fa fa-fw text-gray-lighter fa-trash m-r-1"></i> Apagar</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">Não há dados :(</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
            <tr>
                <td colspan="9">
                    @if(isset($_GET['pesquisa']))
                        {{ $jogos->appends($_GET)->links() }}
                    @else
                        {{ $jogos->links() }}
                    @endif
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalJjogoDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&#xD7;</span></button>
                    <h4 class="modal-title" id="myModalLabel">ATENÇÃO</h4>
                </div>
                <div class="modal-body">
                    <h4 class="text-center" id="mensagem"></h4>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                        <a href="" class="btn btn-primary" id="btnJogoDelete">Sim</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Live Demo -->
@endsection
