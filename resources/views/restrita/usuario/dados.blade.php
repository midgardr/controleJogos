@extends('restrita.template')
@section('titulo', 'SEUS DADOS')
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
            EDITAR MEUS DADOS
        </li>
    </ol>
@endsection
@section('conteudo')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default b-a-2 no-bg b-gray-dark">
                <div class="panel-body">
                    <h2 class="text-center f-w-300 m-b-0">ATUALIZAR MEUS DADOS</h2>
                    <form class="m-t-3" name="casdastro" method="post" action="{{route('usuario.update', $user)}}" enctype="application/x-www-form-urlencoded">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="name">Seu nome</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Digite seu nome completo" value="{{$user->name}}" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="psn_id">PSN ID</label>
                            <input type="text" name="psn_id" id="psn_id" class="form-control" placeholder="Qual a sua ID na PSN?" value="{{$user->psn_id}}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Seu endereço de e-mail" value="{{$user->email}}" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Crie uma senha" required data-container="body" data-toggle="popover" data-placement="right" data-content="ATENÇÃO! Por motivos de segurança, não utilize nesse cadastro a mesma senha que utiliza para acessar o seu e-mail pessoal ou PSN! Não nos responsabilizamos por possíveis vazamento de informações preciosas!">
                        </div>
                        <div class="form-group">
                            <label for="password2">Repita a senha</label>
                            <input type="password" name="password2" id="password2" class="form-control" placeholder="Repita a senha" required>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" required> <b>Declaro que não estou utilizando nesse cadastro a mesma senha que utilizo no meu e-mail ou PSN por motivos de segurança!</b>
                            </label>
                        </div>
                        <button class="btn btn-block m-b-2 btn-primary"><i class="fa fa-save"></i> ATUALIZAR</button>
                        <a href="{{route('dashboard')}}" class="btn btn-block m-b-2 btn-minsk"><i class="fa fa-arrow-circle-left"></i> VOLTAR</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
