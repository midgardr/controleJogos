@component('mail::message')
    <p style="text-align: justify;">Olá {{$user->name}}, foi você mesmo que realizou o cadastro utilizando esse endereço de e-mail para se registrar e utilizar do nosso Catálogo Gamer gratuito? Se sim, por favor, confirme seu endereço de e-mail clicando no botão abaixo:</p>
    @component('mail::button', ['url'=>'http://controledeplatina.com.br/confirmacao/'.$user->uuid])
        Confirmar meu endereço de e-mail
    @endcomponent
    <p style="text-align: justify;">Caso não tenha sido você, por favor, apenas desconsidere esse e-mail!</p>
    <h3>ESTE É UM E-MAIL AUTOMÁTICO, POR FAVOR, NÃO RESPONDA O MESMO!</h3>
@endcomponent
