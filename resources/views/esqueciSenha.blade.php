@extends('template')
@section('conteudo')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default b-a-2 no-bg b-gray-dark">
                <div class="panel-heading text-center">
                    <img src="{{asset('img/logo4.png')}}" width="130">
                </div>
                <div class="panel-body">
                    <h2 class="text-center f-w-300 m-b-0">ESQUECI MINHA SENHA</h2>
                    <form class="m-t-3" name="casdastro" method="post" action="{{route('usuario.esqueciSenha2')}}" enctype="application/x-www-form-urlencoded">
                        @csrf
                        <div class="form-group">
                            <label for="psn_id">Qual é a sua PSN ID?</label>
                            <input type="text" name="psn_id" id="psn_id" class="form-control" placeholder="Qual a sua ID na PSN?" value="{{old('psn_id')}}" required autocomplete="off" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="email">Qual é o seu E-mail registrado?</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Seu endereço de e-mail" value="{{old('email')}}" required autocomplete="off">
                        </div>
                        <button class="btn m-b-2 btn-primary"><i class="fa fa-save"></i> ENVIAR</button>
                    </form>
                </div>
            </div>
            <p class="text-center">
                <strong class="m-r-1">CATÁLOGO DE JOGOS</strong>
                <span>&#xA9; {{date('Y')}}. By CONTROLE DE PLATINA</span>
            </p>
        </div>
    </div>
@endsection
