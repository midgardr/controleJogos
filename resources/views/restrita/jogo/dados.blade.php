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
        <li>
            <a href="{{route('jogo.index')}}"><i class="fa fa-fw fa-gamepad"></i> MEUS JOGOS</a>
        </li>
        <li class="active">
             DADOS DO JOGO
        </li>
    </ol>
@endsection
@section('conteudo')
    <div class="row">
        @if(isset($jogo) && !empty($jogo->print))
            <div class="col-md-4">
                <div class="panel panel-default b-a-2 no-bg b-gray-dark">
                    <div class="panel-body">
                        <img src="{{ asset('uploads/'.Auth::user()->uuid.'/prints/'. $jogo->print) }}" class="img-rounded m-r-1 img-responsive center-block" data-toggle="modal" data-target="#printModal">
                    </div>
                </div>
            </div>
        @endif
        <div class="col-md-{{(isset($jogo) && !empty($jogo->print))?'8':'12'}}">
            <div class="panel panel-default b-a-2 no-bg b-gray-dark">
                <div class="panel-body">
                    <h2 class="text-center f-w-300 m-b-0">{{isset($jogo)?'ATUALIZAR JOGO':'CASTRADAR NOVO JOGO'}}</h2>
                    <form class="m-t-3" name="cadastro" method="post" action="{{isset($jogo)?route('jogo.update', $jogo):route('jogo.store')}}" enctype="multipart/form-data">
                        @csrf
                        @if(isset($jogo))
                            @method('PUT')
                        @endif
                        <div class="form-group">
                            <label for="name">Título</label>
                            <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Título do jogo" value="{{isset($jogo)?$jogo->titulo:old('titulo')}}" required autofocus>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="plataforma">Plataforma</label>
                                <div class="form-group">
                                    <select name="plataforma" id="single" class="form-control select2 select2-input" required>
                                        <option value="">Plataforma</option>
                                        @foreach($plataformas as $plataforma)
                                            <option value="{{$plataforma}}"{{(isset($jogo) && $plataforma == $jogo->plataforma)?' selected="selected':''}}>{{$plataforma}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="publisher">Publisher</label>
                                <select name="publisher" id="single" class="form-control select2 select2-input" required>
                                    <option value="">Publisher</option>
                                    @foreach($publishers as $publisher)
                                        <option value="{{$publisher}}"{{(isset($jogo) && $publisher == $jogo->publisher)?' selected="selected':''}}>{{$publisher}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="dificuldade">Dificuldade</label>
                                <select name="dificuldade" id="single" class="form-control select2 select2-input" required>
                                    <option value="">Dificuldade</option>
                                    @foreach($dificuldades as $dificuldade)
                                        <option value="{{$dificuldade}}"{{(isset($jogo) && $dificuldade == $jogo->dificuldade)?' selected="selected':''}}>{{$dificuldade}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="situacao">Situação</label>
                                <select name="situacao" id="single" class="form-control select2 select2-input" required>
                                    <option value="">Situação</option>
                                    @foreach($situacoes as $situacao)
                                        <option value="{{$situacao}}"{{(isset($jogo) && $situacao == $jogo->situacao)?' selected="selected':''}}>{{$situacao}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="exclusivo">Exclusivo</label>
                                <select name="exclusivo" id="single" class="form-control select2 select2-input" required>
                                    <option value="0">Não</option>
                                    <option value="1"{{(isset($jogo) && $jogo->exclusivo == 1)?' selected="selected':''}}>Sim</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="repetido">Repetido</label>
                                <select name="repetido" id="single" class="form-control select2 select2-input" required>
                                    <option value="0">Não</option>
                                    <option value="1"{{(isset($jogo) && $jogo->repetido == 1)?' selected="selected':''}}>Sim</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="platinado_em">Platinado em</label>
                                <div class="input-group select2-bootstrap-prepend">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <div id="daterangepicker-container">
                                        <input type="text" class="form-control" name="platinado_em" id="platinado_em" value="{{isset($jogo)?$jogo->platinado_em:old('platinado_em')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="guia1">Guia 1</label>
                                <div class="input-group select2-bootstrap-prepend">
                                    <span class="input-group-addon">
                                        <i class="fa fa-link"></i>
                                    </span>
                                    <input type="url" name="guia1" id="guia1" class="form-control" placeholder="URL de guia de troféu ou vídeo" value="{{isset($jogo)?$jogo->guia1:old('guia1')}}">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="guia2">Guia 2</label>
                                <div class="input-group select2-bootstrap-prepend">
                                    <span class="input-group-addon">
                                        <i class="fa fa-link"></i>
                                    </span>
                                    <input type="url" name="guia2" id="guia2" class="form-control" placeholder="URL de guia de troféu ou vídeo" value="{{isset($jogo)?$jogo->guia2:old('guia1')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="print">Print da platina</label>
                                <div class="input-group select2-bootstrap-prepend">
                                    <span class="input-group-addon">
                                        <i class="fa fa-image"></i>
                                    </span>
                                    <input type="file" name="print" id="print" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="observacoes" class="control-label">Observações</label>
                            <textarea name="observacoes" id="observacoes" class="form-control" rows="3">{{isset($jogo)?$jogo->observacoes:old('observacoes')}}</textarea>
                        </div>
                        <button class="btn m-b-2 btn-primary"><i class="fa fa-save"></i> SALVAR</button>
                        <a href="{{route('jogo.create')}}" class="btn m-b-2 btn-success"><i class="fa fa-plus"></i> NOVO</a>
                        <a href="{{route('jogo.index')}}" class="btn m-b-2 btn-minsk"><i class="fa fa-arrow-circle-left"></i> VOLTAR</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if(isset($jogo) && !empty($jogo->print))
    <!-- Modal -->
    <div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&#xD7;</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{"{$jogo->titulo} - {$jogo->platinado_em}"}}</h4>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('uploads/'.Auth::user()->uuid.'/prints/'. $jogo->print) }}" class="img-rounded m-r-1 img-responsive center-block">
                    <h4 class="text-center">{!! "Plataforma: {$jogo->plataforma} - Publicado por: {$jogo->publisher} - Dificuldade da platina: {$jogo->dificuldade}"!!}</h4>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END Live Demo -->
    @endif
@endsection
