@extends('template')
@section('conteudo')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default b-a-2 no-bg b-gray-dark">
                <div class="panel-heading text-center">
                    <img src="{{asset('img/logo4.png')}}" width="130">
                </div>
                <div class="panel-body">
                    <h2 class="text-center f-w-300 m-b-0">FAÇA SEU CADASTRO</h2>
                    <form class="m-t-3" name="casdastro" method="post" action="{{route('usuario.store')}}" enctype="application/x-www-form-urlencoded">
                        @csrf
                        <div class="form-group">
                            <label for="name">Seu nome</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Digite seu nome completo" value="{{old('name')}}" required autofocus autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="psn_id">PSN ID</label>
                            <input type="text" name="psn_id" id="psn_id" class="form-control" placeholder="Qual a sua ID na PSN?" value="{{old('psn_id')}}" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Seu endereço de e-mail" value="{{old('email')}}" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Crie uma senha" required data-container="body" data-toggle="popover" data-placement="top" data-content="ATENÇÃO! Por motivos de segurança, não utilize nesse cadastro a mesma senha que utiliza para acessar o seu e-mail pessoal ou PSN! Não nos responsabilizamos por possíveis vazamento de informações preciosas!" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="password2">Repita a senha</label>
                            <input type="password" name="password2" id="password2" class="form-control" placeholder="Repita a senha" required autocomplete="off">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" required> <b>Declaro que não estou utilizando nesse cadastro a mesma senha que utilizo no meu e-mail ou PSN por motivos de segurança!</b>
                            </label>
                        </div>
                        <button class="btn m-b-2 btn-primary"><i class="fa fa-save"></i> SALVAR</button>
                    </form>
                </div>
                <div class="panel-footer b-a-0 b-r-a-0">
                    <a href="{{route('usuario.esqueciSenha1')}}">Esqueci minha senha!</a>
                    <a href="{{route('formLogin')}}" class="pull-right">Já tem cadastro? Então Logue!</a>
                </div>
            </div>
            <p class="text-center">
                <span>&#xA9; {{date('Y')}}. By <a href="https://www.youtube.com/channel/UC8HrnYy-RaLof9VyYgTjMgg" target="_blank"><i class="fa fa-youtube"></i> CONTROLE DE PLATINA</a></span>
            </p>
        </div>
    </div>
@endsection
