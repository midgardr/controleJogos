@extends('adm.template')
@section('titulo', 'VÍDEOS')
@section('migalhas')
    <ol class="breadcrumb navbar-text navbar-right no-bg">
        <li class="current-parent">
            <a class="current-parent" href="{{route('video.index')}}">
                <i class="fa fa-fw fa-pie-chart"></i>
            </a>
        </li>
        <li>
            <a href="{{route('video.index')}}">VÍDEOS</a>
        </li>
        <li class="active">
            <a href="#">DADOS</a>
        </li>
    </ol>
@endsection
@section('conteudo')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default b-a-2 no-bg b-gray-dark">
                <div class="panel-body">
                    <h2 class="text-center f-w-300 m-b-0">{{isset($video)?'ATUALIZAR VÍDEO':'CASTRADAR NOVO VÍDEO'}}</h2>
                    <form class="m-t-3" name="cadastro" method="post" action="{{isset($video)?route('video.update', $video):route('video.store')}}" enctype="multipart/form-data">
                        @csrf
                        @if(isset($video))
                            @method('PUT')
                        @endif
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Título do vídeo" value="{{isset($video)?$video->titulo:old('video')}}" required autofocus>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="categoria">Categoria</label>
                            <div class="form-group">
                                <select name="categoria" id="single" class="form-control select2 select2-input" required>
                                    <option value="">Categoria</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{$categoria}}"{{(isset($video) && $categoria == $video->categoria)?' selected="selected':''}}>{{$categoria}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="url">URL</label>
                            <input type="url" name="url" id="url" class="form-control" placeholder="URL" value="{{isset($video)?$video->url:old('url')}}" required>
                        </div>
                        <button class="btn m-b-2 btn-primary"><i class="fa fa-save"></i> SALVAR</button>
                        <a href="{{route('video.create')}}" class="btn m-b-2 btn-success"><i class="fa fa-plus"></i> NOVO</a>
                        <a href="{{route('video.index')}}" class="btn m-b-2 btn-minsk"><i class="fa fa-arrow-circle-left"></i> VOLTAR</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
