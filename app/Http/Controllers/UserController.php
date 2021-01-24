<?php

namespace App\Http\Controllers;

use App\Mail\Email;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller{
    protected $user;
    public function __construct(User $user){
        $this->user = $user;
    }

    public function formLogin(){
        return view('login');
    }

    public function login(Request $request){
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            if(Auth::user()->verificado == 1){
                return redirect()->route('dashboard')->with(['tipo'=>'success', 'titulo'=>'Seja bem vindo!', 'mensagem'=>'Aproveite todos os recursos do sistema :)']);;
            } else {
                return redirect()->back()->with(['tipo'=>'warning', 'titulo'=>'Atenção!', 'mensagem'=>'Seu e-mail não foi verificado ainda!']);
            }
        }
        return redirect()->back()->with(['tipo'=>'warning', 'titulo'=>'Atenção!', 'mensagem'=>'E-mail e/ou senha inválido(s).']);
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('formLogin')->with(['tipo'=>'success', 'titulo'=>'Até mais!', 'mensagem'=>'Esperamos você em breve.']);
    }
    public function notAuthorized(){
        return redirect()->route('formLogin')->with(['tipo'=>'error', 'titulo'=>'Opa!', 'mensagem'=>'Tá tentando entrar no sitema sem logar!']);
    }

    public function index(Request $request){

    }

    public function create(){
        return view('cadastro');
    }

    public function store(Request $request){
        if($request->password != $request->password2){
            return redirect()->back()->with(['tipo'=>'warning', 'titulo'=>'Atenção!', 'mensagem'=>'As senhas não conferem!'])->withInput();
        } else {
            $user = $this->user;
            try{
                $user->uuid = md5(uniqid(rand(), true));
                $user->name = $request->name;
                $user->email = trim($request->email);
                $user->psn_id = trim($request->psn_id);
                $user->password = bcrypt($request->password);
                $user->save();
                $dir = 'uploads/'.$user->uuid.'/prints/';
                if(!File::isDirectory($dir)){
                    File::makeDirectory($dir, 0777, true, true);
                }
                //return new Email($user, 'Controle de Platina - E-mail de confirmação');
                Mail::send(new Email($user, 'Controle de Platina - E-mail de confirmação', 'verificacao', null));
                return redirect()->route('formLogin')->with(['tipo'=>'success', 'Obrigado!', 'mensagem'=>"Seu cadastro foi realizado com sucesso! Verifique o seu e-mail para ativar o seu cadastro!"]);
            } catch (\Exception $e){
                //dd($e->getMessage());
                return redirect()->back()->with(['tipo'=>'error', 'mensagem'=>$e->getMessage()]);
            }
        }
    }

    public function edit(User $user){
        return view('restrita.usuario.dados', compact('user'));
    }

    public function update(Request $request, User $user){
        if($request->password != $request->password2){
            return redirect()->back()->with(['tipo'=>'warning', 'titulo'=>'Atenção!', 'mensagem'=>'As senhas não conferem!'])->withInput();
        } else {
            $mensagem = '';
            if ($user->email != $request->email) {
                $user->verificado = 0;
                $mensagem = ' Mas você precisa confirmar seu novo endereço de e-mail! Acesso o mesmo para fazer a confirmação!';
            }
            try {
                $user->name = $request->name;
                $user->email = $request->email;
                $user->psn_id = $request->psn_id;
                $user->password = bcrypt($request->password);
                $user->save();
                return redirect()->back()->with(['tipo'=>'success', 'titulo'=>'Parabéns!', 'mensagem'=>"Seus dados foram atualizados com sucesso! {$mensagem}"]);
            } catch (\Exception $e) {
                return redirect()->back()->with(['tipo'=>'error', 'mensagem'=>$e->getMessage()]);
            }
        }
    }

    public function delete(User $user){
        DB::beginTransaction();
        try{
            $nome = $user->name;
            $user->delete();
            File::deleteDirectory('uploads/'.$user->uuid);
            DB::commit();
            return redirect()->route('inicio')->with(['tipo'=>'success', 'titulo'=>'Parabéns', 'mensagem'=>"Usuário {$nome} excluído com sucesso!"]);
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with(['tipo'=>'error', 'mensagem'=>$e->getMessage()]);
        }
    }

    public function confirmacao(String $uuid){
        $user = $this->user->where('uuid', $uuid)->first();
        if(!empty($user)){
            $user->verificado = 1;
            $user->save();
            return redirect()->route('formLogin')->with(['tipo'=>'success', 'titulo'=>'Confirmação', 'mensagem'=>'Parabéns, seu cadastro foi verificado com sucesso! Pode logar e desfrutar do catálogo!']);
        } else {
            return redirect()->route('formLogin')->with(['tipo'=>'error', 'titulo'=>'Confirmação', 'mensagem'=>'Não foi possível verificar o seu cadastro!']);
        }
    }

    public function esqueciSenha1(){
        return view('esqueciSenha');
    }
    public function esqueciSenha2(Request $request){
        $user = $this->user->where(['psn_id'=>$request->psn_id, 'email'=>$request->email])->first();
        if(!empty($user)){
            $novaSenha = substr(md5(uniqid(rand(), true)),0,8);
            $user->password = bcrypt($novaSenha);
            $user->save();
            //return new Email($user, 'Controle de Platina - Recuperação de senha', 'recuperacao', $novaSenha);
            Mail::send(new Email($user, 'Controle de Platina - Recuperação de senha', 'recuperacao', $novaSenha));
            return redirect()->route('formLogin')->with(['tipo'=>'success', 'titulo'=>'Recuperação de senha', 'mensagem'=>'Lhe enviamos um e-mail com a nova senha!']);
        } else {
            return redirect()->back()->with(['tipo'=>'error', 'titulo'=>'Recuperação de senha', 'mensagem'=>'Não foi possível localizar o seu cadastro!']);
        }
    }
}
