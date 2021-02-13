@extends('adm.template')
@section('titulo', 'VÍDEOS')
@section('migalhas')
    <ol class="breadcrumb navbar-text navbar-right no-bg">
        <li class="current-parent">
            <a class="current-parent" href="{{route('video.index')}}">
                <i class="fa fa-fw fa-youtube"></i>
            </a>
        </li>
        <li class="action">
            <a href="{{route('video.index')}}">VÍDEOS</a>
        </li>
    </ol>
@endsection
@section('conteudo')
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                <form class="form-inline" method="get" action="{{route('video.index')}}" name="filtro" enctype="application/x-www-form-urlencoded">
                    <input type="hidden" name="pesquisa" value="true">
                    <div class="form-group">
                        <input type="search" name="titulo" class="form-control" placeholder="Buscar vídeo..." value="{{isset($_GET['titulo'])?$_GET['titulo']:''}}" autofocus>
                    </div>
                    <div class="form-group">
                        <select name="categoria" id="single" class="form-control select2 select2-input">
                            <option value="">CATEGORIA</option>
                            @foreach($categorias as $categoria)
                                <option value="{{$categoria}}"{{(isset($_GET['categoria']) and $categoria == $_GET['categoria'])?' selected':''}}>{{$categoria}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-search"></i></button>
                </form>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 pull-right">
                <a href="{{route('video.create')}}" class="btn btn-info"><i class="fa fa-fw fa-plus"></i></a>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="col-lg-12">
        <table class="table table-hover table-bordered table-striped">
            <thead>
            <tr>
                <th class="small text-muted text-uppercase"><strong>Título</strong></th>
                <th class="small text-muted text-uppercase text-center"><strong>Categoria</strong></th>
                <th class="small text-muted text-uppercase text-center"><strong>Cadastrado em</strong></th>
                <th class="small text-muted text-uppercase text-right"><strong>Ações</strong></th>
            </tr>
            </thead>
            <tbody>
            @forelse($videos as $video)
                <tr>
                    <td class="v-a-m">
                        <h5 class="m-b-0"><span>{{$video->titulo}}</span></h5>
                    </td>
                    <td class="v-a-m">
                        <h5 class="m-b-0"><span>{{$video->categoria}}</span></h5>
                    </td>
                    <td class="v-a-m text-center">
                        <h5 class="m-b-0"><span>{{$video->created_at}}</span></h5>
                    </td>
                    <td class="text-right v-a-m">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="fa fa-bars m-r-1"></i> <span class="caret"></span> </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="{{route('video.edit', $video)}}"><i class="fa fa-fw text-gray-lighter fa-pencil m-r-1"></i> Editar</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{route('video.delete', $video)}}"><i class="fa fa-fw text-gray-lighter fa-trash m-r-1"></i> Apagar</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Não há dados :(</td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">
                        @if(isset($_GET['pesquisa']))
                            {{ $videos->appends($_GET)->links() }}
                        @else
                            {{ $videos->links() }}
                        @endif
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
