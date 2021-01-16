<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jogo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class JogoController extends Controller{
    protected $jogo;
    private $plataformas = [
        'PS3',
        'PS4',
        'PSVita',
        'PS5'
    ];
    private $publishers = [
        'Activision Blizzard',
        '505 Games',
        'Aksys Games',
        'Apple',
        'Atlus',
        'Bandai Namco',
        'Capcom',
        'Deep Silver',
        'Devolver Digital',
        'EA',
        'Focus Home Interactive',
        'Google',
        'Koei Tecmo',
        'Konami',
        'Microsoft',
        'NetEase',
        'Nintendo',
        'NIS America',
        'Paradox Interactive',
        'Sega',
        'Slitherine Strategies',
        'Sony',
        'Take-Two',
        'Telltale Games',
        'Tencent Games',
        'Ubisoft',
        'Warner Bros.',
        'Zen Studios',
        'Outra'
    ];
    private $dificuldades = [
        'Garapa',
        'Fácil',
        'Normal',
        'Difícil',
        'Insano'
    ];
    private $situacoes = [
        'Não lançado',
        'Não comprado',
        'A jogar',
        'Jogando',
        'Platinado',
        'Desistido'
    ];

    public function __construct(Jogo $jogo){
        $this->jogo = $jogo;
    }

    public function index(Request $request){
        $queryMetricas = $this->jogo;
        $metricas = [];
        $metricas['todosJogos'] = $queryMetricas->all()->count();
        $metricas['exclusivos'] = $queryMetricas->where('exclusivo', 1)->count();
        $metricas['multiplataformas'] = $queryMetricas->where('exclusivo', 0)->count();
        $metricas['naoPlatinados'] = $queryMetricas->where('situacao', '<>', 'Platinado')->count();
        $metricas['platinados'] = $queryMetricas->where('situacao', 'Platinado')->count();
        $metricas['ineditos'] = $queryMetricas->where('repetido', 0)->count();
        $metricas['repetidos'] = $queryMetricas->where('repetido', 1)->count();

        $plataformas = $this->plataformas;
        $publishers = $this->publishers;
        $dificuldades = $this->dificuldades;
        $situacoes = $this->situacoes;

        $queryJogos = $this->jogo->orderBy('titulo');
        if(!empty($request->titulo)){
            $queryJogos->where('titulo', 'LIKE', '%'.$request->titulo.'%');
        }
        if(!empty($request->plataforma)){
            $queryJogos->where('plataforma', $request->plataforma);
        }
        if(!empty($request->publisher)){
            $queryJogos->where('plataforma', $request->plataforma);
        }
        if(!empty($request->exclusivos)){
            $queryJogos->where('exclusivo', 1);
        }
        if(!empty($request->multipltaformas)){
            $queryJogos->where('exclusivo', 0);
        }
        if(!empty($request->ineditos)){
            $queryJogos->where('repetido', 0);
        }
        if(!empty($request->repetidos)){
            $queryJogos->where('repetido', 1);
        }
        if(!empty($request->dificuldade)){
            $queryJogos->where('dificuldade', $request->dificuldade);
        }
        if(!empty($request->platinados)){
            $queryJogos->where('situacao', 'Platinado');
        }
        if(!empty($request->naoPlatinados)){
            $queryJogos->where('situacao', '<>' , 'Platinado');
        }
        if(!empty($request->situacao)){
            $queryJogos->where('situacao', $request->situacao);
        }
        $jogos = $queryJogos->paginate(30);
        return view('restrita.jogo.index', compact(['jogos', 'plataformas', 'publishers', 'dificuldades', 'situacoes', 'metricas']));
    }

    public function create(){
        $plataformas = $this->plataformas;
        $publishers = $this->publishers;
        $dificuldades = $this->dificuldades;
        $situacoes = $this->situacoes;
        return view('restrita.jogo.dados', compact(['plataformas', 'publishers', 'dificuldades', 'situacoes']));
    }
    public function store(Request $request){
        try{
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
            if($request->hasFile('print')){
                $jogo->print = $this->uploadFoto($request->print);
                $jogo->save();
            }
            return redirect()->route('jogo.edit', $jogo)->with(['tipo'=>'success', 'titulo'=>'Sucesso!', 'mensagem'=>"Novo jogo inserido!"]);
        } catch (\Exception $e){
            return redirect()->back()->with(['tipo'=>'error', 'titulo'=>'Deu Ruim!', 'mensagem'=>$e->getMessage()])->withInput();
        }
    }

    public function edit(Jogo $jogo){
        $plataformas = $this->plataformas;
        $publishers = $this->publishers;
        $dificuldades = $this->dificuldades;
        $situacoes = $this->situacoes;
        return view('restrita.jogo.dados', compact(['jogo','plataformas', 'publishers', 'dificuldades', 'situacoes']));
    }

    public function update(Request $request, Jogo $jogo){
        try{
            if($request->hasFile('print')){
                File::delete(storage_path('app/public/jogos/') . $jogo->print);
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
            return redirect()->back()->with(['tipo'=>'success', 'titulo'=>'Sucesso!', 'mensagem'=>"Jogo atualizado!"]);
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with(['tipo'=>'error', 'titulo'=>'Deu Ruim!', 'mensagem'=>$e->getMessage()])->withInput();
        }
    }
    public function delete(Jogo $jogo){
        DB::beginTransaction();
        try{
            if(!empty($jogo->print)){
                File::delete(storage_path('app/public/jogos/') . $jogo->print);
            }
            $jogo->delete();
            DB::commit();
            return redirect()->back()->with(['tipo'=>'success', 'titulo'=>'Sucesso', 'mensagem'=>"Jogo apagado!"]);
        } catch (\Exception $e){
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
        Image::make($foto->getRealPath())->resize(600, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($caminho, 30);
        return $nome;
    }
}
