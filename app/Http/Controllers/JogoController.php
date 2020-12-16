<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jogo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class JogoController extends Controller
{
    protected $jogo;
    private $plataformas = ['PS3', 'PS4', 'PSVita', 'PS5'];
    private $dificuldades = [';Garapa','Fácil','Normal','Difícil','Insano'];
    private $situacoes = ['Não lançado','A platinar','Platinando','Platinado','Não platinado'];

    public function __construct(Jogo $jogo)
    {
        $this->jogo = $jogo;
    }

    public function index(Request $request)
    {
        $query = $this->jogo;
        $plataformas = $this->plataformas;
        $dificuldades = $this->dificuldades;
        $situacoes = $this->situacoes;
        if(!empty($request->titulo))
        {
            $query->where('titulo', 'LIKE', '%'.$request->titulo.'%');
        }
        if(!empty($request->plataforma))
        {
            $query->where('plataforma', $request->plataforma);
        }
        if(!empty($request->exclusivo))
        {
            $query->where('exclusivo', 1);
        }
        if(!empty($request->repetido))
        {
            $query->where('repetido', 1);
        }
        if(!empty($request->dificuldade))
        {
            $query->where('dificuldade', $request->dificuldade);
        }
        if(!empty($request->situacao))
        {
            $query->where('situacao', $request->situacao);
        }
        if(!empty($request->ordenacao))
        {
            $query->orderBy($request->ordenacao, $request->sentido);
        }
        $jogos = $query->paginate(30);
        return view('restrita.jogo.index', compact(['jogos', 'plataformas', 'dificuldades', 'situacoes']));
    }

    public function create()
    {
        $plataformas = $this->plataformas;
        $dificuldades = $this->dificuldades;
        $situacoes = $this->situacoes;
        return view('restrita.jogo.dados', compact(['plataformas', 'dificuldades', 'situacoes']));
    }
    public function store(Request $request)
    {
        try
        {
            $jogo = $this->jogo;
            $jogo->user_id = Auth::user()->id;
            $jogo->titulo = $request->titulo;
            $jogo->plataforma = $request->plataforma;
            $jogo->exclusivo = $request->exclusivo;
            $jogo->repetido = $request->repetido;
            $jogo->dificuldade = $request->dificuldade;
            $jogo->situacao = $request->situacao;
            $jogo->platinado_em = $request->platinado_em;
            $jogo->guia1 = $request->guia1;
            $jogo->guia2 = $request->guia2;
            $jogo->print = $this->uploadFoto($request->print);
            $jogo->save();
            if($request->hasFile('print')) {
                $jogo->print = $this->uploadFoto($request->print);
                $jogo->save();
            }
            return redirect()->route('jogo.edit', compact('jogo','plataformas', 'dificuldades', 'situacoes'))->with(['tipo'=>'success', 'mensagem'=>"Novo jogo inserido!"]);
        } catch (\Exception $e)
        {
            return redirect()->back()->with(['tipo'=>'error', 'mensagem'=>$e->getMessage()]);
        }
    }

    public function edit(Jogo $jogo)
    {
        $plataformas = $this->plataformas;
        $dificuldades = $this->dificuldades;
        $situacoes = $this->situacoes;
        return view('restrita.jogo.dados', compact(['jogo','plataformas', 'dificuldades', 'situacoes']));
    }

    public function update(Request $request, Jogo $jogo)
    {
        try
        {
            if($request->hasFile('foto')){
                File::delete(storage_path('app/public/jogos') . $jogo->print);
                $jogo->print = $this->uploadFoto($request->print);
            }
            $jogo->titulo = $request->titulo;
            $jogo->plataforma = $request->plataforma;
            $jogo->exclusivo = $request->exclusivo;
            $jogo->repetido = $request->repetido;
            $jogo->dificuldade = $request->dificuldade;
            $jogo->situacao = $request->situacao;
            $jogo->platinado_em = $request->platinado_em;
            $jogo->guia1 = $request->guia1;
            $jogo->guia2 = $request->guia2;
            $jogo->save();
            DB::commit();
            return redirect()->back()->with(['tipo'=>'success', 'mensagem'=>"Jogo atualizado!"]);
        } catch (\Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->with(['tipo'=>'error', 'mensagem'=>$e->getMessage()]);
        }
    }
    public function delete(Jogo $jogo)
    {
        DB::beginTransaction();
        try
        {
            if(!empty($jogo->print))
            {
                File::delete(storage_path('app/public/jogos') . $jogo->print);
            }
            $jogo->delete();
            DB::commit();
            return redirect()->back()->with(['tipo'=>'success', 'mensagem'=>"Jogo apagado!"]);
        } catch (\Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->with(['tipo'=>'error', 'mensagem'=>$e->getMessage()]);
        }
    }
    public function nomeFoto($foto){
        $nome = uniqid(time()) . '.'. $foto->getClientOriginalExtension();
        $dir = storage_path('app/public/jogos/');

        if(file_exists($dir . $nome)){
            return $this->nomeFoto($foto);
        }
        return $nome;
    }
    protected function uploadFoto($foto){
        $nome  =  $this->nomeFoto($foto);
        $caminho = storage_path('app/public/jogos/') . $nome;
        Image::make($foto->getRealPath())->resize(365, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($caminho);
        return $nome;
    }
}
