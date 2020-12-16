<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password], $request->remember))
        {
            return redirect()->route('dashboard');
        }
        return redirect()->back()->with(['tipo'=>'warning', 'mensagem'=>'E-mail e/ou senha inválido(s).']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('formLogin');
    }
    public function notAuthorized()
    {
        return redirect()->route('formLogin');
    }

    public function index(Request $request)
    {

    }

    public function create()
    {
        return view('cadastro');
    }

    public function store(Request $request)
    {
        $user = $this->user;
        try
        {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->psn_id = $request->psn_id;
            $user->password = bcrypt('platinador');
            $user->save();
            return redirect()->route('usuario.edit', $user)->with(['tipo'=>'success', 'mensagem'=>"Usuário {$user->name} cadastrado com sucesso!"]);
        } catch (\Exception $e)
        {
            return redirect()->back()->with(['tipo'=>'error', 'mensagem'=>$e->getMessage()]);
        }
    }

    public function edit(User $user)
    {
        return view('restrita.usuario.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        try
        {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->psn_id = $request->psn_id;
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect()->back()->with(['tipo'=>'success', 'mensagem'=>"Dados do usuário {$user->name} atualizados com sucesso!"]);
        } catch (\Exception $e)
        {
            return redirect()->back()->with(['tipo'=>'error', 'mensagem'=>$e->getMessage()]);
        }
    }

    public function delete(User $user)
    {
        DB::beginTransaction();
        try
        {
            $nome = $user->name;
            $user->delete();
            DB::commit();
            return redirect()->route('inicio')->with(['tipo'=>'success', 'mensagem'=>"Usuário {$nome} excluído com sucesso!"]);
        } catch (\Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->with(['tipo'=>'error', 'mensagem'=>$e->getMessage()]);
        }
    }

    public function dashboard(){

    }
}
