@extends('restrita.template')
@section('titulo', 'GALERIA DE PRINTS')
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
            <i class="fa fa-fw fa-gamepad"></i> <a href="{{route('jogo.index')}}">MEUS JOGOS</a>
        </li>
        <li class="active">
            <i class="fa fa-fw fa-file-image-o"></i> GALERIA DE PRINTS
        </li>
    </ol>
@endsection
@section('conteudo')
    @php $cont = 1; @endphp
    <div class="row">
    @foreach($galeria as $jogo)
        @if($cont > 3)
            @php $cont = 1; @endphp
            </div><div class="row">
        @endif
        <div class="col-xs-6 col-md-4">
            <div class="thumbnail no-bg b-a-2 b-gray-dark">
                <img src="{{ asset('storage/'.Auth::user()->id.'/prints/'. $jogo->print) }}" alt="100%x200" data-holder-rendered="true" data-toggle="modal" data-target="#printModal" data-titulo="{{"{$jogo->titulo} - {$jogo->platinado_em}"}}" data-print="{{ asset('storage/'.Auth::user()->id.'/prints/'. $jogo->print) }}" data-descricao="{{ "Plataforma: {$jogo->plataforma} - Publicado por: {$jogo->publisher} - Dificuldade da platina: {$jogo->dificuldade}"}}">
                <div class="caption">
                    <h4><a href="{{route('jogo.edit', $jogo)}}">{{$jogo->titulo}}</a></h4>
                    <h5>Em {{$jogo->platinado_em}}</h5>
                    <p><b>Plataforma:</b> {{$jogo->plataforma}} | <b>Publisher:</b> {{$jogo->publisher}}</p>
                    <p><b>Dificuldade:</b> {{$jogo->dificuldade}} | {{$jogo->exclusivo==1?'Exclusivo':'Multiplataforma'}}{{$jogo->repetido==1?' | Repetido':''}}</p>
                    </p>
                </div>
            </div>
         </div>
        @php $cont++; @endphp
    @endforeach
    </div>
    <div class="row">
        <div class="text-center">
            {{$galeria->links()}}
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&#xD7;</span></button>
                    <h4 class="modal-title" id="titulo"></h4>
                </div>
                <div class="modal-body">
                    <img id="print" src="" class="img-rounded m-r-1 img-responsive center-block">
                    <h4 class="text-center" id="descricao"></h4>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Live Demo -->
@endsection
