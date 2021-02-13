@extends('template')
@section('conteudo')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default b-a-2 no-bg b-gray-dark">
                <div class="panel-heading text-center">
                    <img src="{{asset('img/logo4.png')}}" width="130">
                </div>
                <div class="panel-body">
                    <h2 class="text-center f-w-300 m-b-0">SEJA BEM VINDO</h2>
                    <form class="m-t-3" name="formLogin" method="post" action="{{route('postLogin')}}" enctype="application/x-www-form-urlencoded">
                        @csrf
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Seu endereço de e-mail..." autofocus required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Sua senha..." required>
                        </div>
                        <button class="btn btn-block m-b-2 btn-primary">ENTRAR</button>
                    </form>
                </div>
                <div class="panel-footer b-a-0 b-r-a-0">
                    <a href="{{route('usuario.esqueciSenha1')}}">Esqueci minha senha!</a>
                    <a href="{{route('usuario.cadastro')}}" class="pull-right">Novo aqui? Cadastre-se!</a>
                </div>
            </div>
            <p class="text-center">
                <span>&#xA9; {{date('Y')}}. By <a href="https://www.youtube.com/channel/UC8HrnYy-RaLof9VyYgTjMgg" target="_blank"><i class="fa fa-youtube"></i> CONTROLE DE PLATINA</a></span>
            </p>
        </div>
    </div>
@endsection
