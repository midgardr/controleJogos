@component('mail::message')
    <p style="text-align: justify;">Olá {{$user->name}}, você solicitou a redefinição da sua senha de acesso ao nosso sistema. Sua senha foi redefinida para <b>{{$senha}}</b></p>
    @component('mail::button', ['url'=>'http://controledeplatina.com.br/'])
        Acessar o sistema
    @endcomponent
    <h3>ESTE É UM E-MAIL AUTOMÁTICO, POR FAVOR, NÃO RESPONDA O MESMO!</h3>
@endcomponent
