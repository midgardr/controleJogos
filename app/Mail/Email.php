<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class Email extends Mailable{
    use Queueable, SerializesModels;
    private $user;
    private $assunto;
    private $tipoEmail;
    private $senhaRecuperacao;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, String $assunto, String $tipoEmail, String $senhaRecuperacao = null ){
        $this->user = $user;
        $this->assunto = $assunto;
        $this->tipoEmail = $tipoEmail;
        $this->senhaRecuperacao = $senhaRecuperacao;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        $this->subject($this->assunto);
        $this->to($this->user->email, $this->user->name);
        $this->from('envioscontroldedeplatina@gmail.com', 'Controle de Platina');
        if($this->tipoEmail == 'verificacao'){
            return $this->markdown('Email.confirmacao', ['user'=>$this->user]);
        } else {
            return $this->markdown('Email.recuperacaoSenha', ['user'=>$this->user, 'senha'=>$this->senhaRecuperacao]);
        }
    }
}
