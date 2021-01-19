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
        'Bethesda Softworks',
        'Capcom',
        'Deep Silver',
        'Devolver Digital',
        'Disney Interactive Studios',
        'EA',
        'Ember Lab',
        'Envolved Games',
        'Focus Home Interactive',
        'Frozenbyte',
        'Gammera Nest',
        'Google',
        'Koei Tecmo',
        'Konami',
        'Lucas Arts',
        'Microsoft',
        'NetEase',
        'Nintendo',
        'NIS America',
        'Paradox Interactive',
        'Rain Games',
        'Sega',
        'Slitherine Strategies',
        'Square-Enix',
        'Sony',
        'Studio MDHR',
        'Take-Two',
        'Team Cherry',
        'Telltale Games',
        'Tencent Games',
        'THQ',
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
        sort($this->publishers);
    }

    public function index(Request $request){
        $queryMetricas = $this->jogo;
        $metricas = [];
        $metricas['todosJogos'] = $queryMetricas->all()->count();
        $metricas['jogando'] = $queryMetricas->where('situacao', 'Jogando')->count();
        $metricas['exclusivos'] = $queryMetricas->where('exclusivo', 1)->count();
        $metricas['multiplataformas'] = $queryMetricas->where('exclusivo', 0)->count();
        $metricas['naoPlatinados'] = $queryMetricas->where('situacao', '<>', 'Platinado')->count();
        $metricas['platinados'] = $queryMetricas->where('situacao', 'Platinado')->count();
        $metricas['ineditos'] = $queryMetricas->where('repetido', 0)->count();
        $metricas['repetidos'] = $queryMetricas->where('repetido', 1)->count();
        $metricas['naoLancados'] = $queryMetricas->where('situacao', 'Não lançado')->count();
        $metricas['naoComprados'] = $queryMetricas->where('situacao', 'Não comprado')->count();
        $metricas['desistidos'] = $queryMetricas->where('situacao', 'Desistido')->count();
        $metricas['naoGarapas'] = $queryMetricas->where('dificuldade', '<>', 'Garapa')->count();
        $metricas['somenteGuia'] = $queryMetricas->where('guia1', '<>', '')->orwhere('guia2', '<>', '')->count();

        $plataformas = $this->plataformas;
        $publishers = $this->publishers;
        $dificuldades = $this->dificuldades;
        $situacoes = $this->situacoes;


        $queryJogos = $this->jogo->where('user_id', Auth::user()->id);
        if(!empty($request->titulo)){
            $queryJogos->where('titulo', 'LIKE', '%'.$request->titulo.'%');
        }
        if(!empty($request->plataforma)){
            $queryJogos->where('plataforma', $request->plataforma);
        }
        if(!empty($request->publisher)){
            $queryJogos->where('publisher', $request->publisher);
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
        if(!empty($request->naoLancados)){
            $queryJogos->where('situacao', 'Não lançado');
        }
        if(!empty($request->jogando)){
            $queryJogos->where('situacao', 'Jogando');
        }
        if(!empty($request->desistidos)){
            $queryJogos->where('situacao', 'Desistido');
        }
        if(!empty($request->situacao)){
            $queryJogos->where('situacao', $request->situacao);
        }
        if(!empty($request->naoGarapas)){
            $queryJogos->where('dificuldade', '<>', 'Garapa');
        }
        if(!empty($request->somenteGuia)){
            $queryJogos->where('guia1', '<>', '')->orWhere('guia2', '<>', '');
        }
        $jogos = $queryJogos->orderBy('titulo')->paginate(10);
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
            $jogo->publisher = $request->publisher;
            $jogo->exclusivo = $request->exclusivo;
            $jogo->repetido = $request->repetido;
            $jogo->dificuldade = $request->dificuldade;
            if ($request->platinado_em != '__/__/____') {
                $jogo->situacao = 'Platinado';
                $jogo->platinado_em = $request->platinado_em;
            } else {
                $jogo->situacao = $request->situacao;
                $jogo->platinado_em = null;
            }
            $jogo->guia1 = $request->guia1;
            $jogo->guia2 = $request->guia2;
            if($request->hasFile('print')){
                $jogo->print = $this->uploadFoto($request->print);
            }
            $jogo->save();
            return redirect()->route('jogo.edit', $jogo)->with(['tipo'=>'success', 'titulo'=>'Sucesso!', 'mensagem'=>"Novo jogo inserido!"]);
        } catch (\Exception $e){
            return redirect()->back()->with(['tipo'=>'error', 'titulo'=>'Deu Ruim!', 'mensagem'=>$e->getMessage()])->withInput();
        }
    }

    public function edit(Jogo $jogo){
        if($jogo->user_id <> Auth::user()->id){
            return redirect()->back();
        } else {
            $plataformas = $this->plataformas;
            $publishers = $this->publishers;
            $dificuldades = $this->dificuldades;
            $situacoes = $this->situacoes;
            return view('restrita.jogo.dados', compact(['jogo','plataformas', 'publishers', 'dificuldades', 'situacoes']));
        }
    }

    public function update(Request $request, Jogo $jogo){
        if($jogo->user_id <> Auth::user()->id){
            return redirect()->back();
        } else {
            try {
                if ($request->hasFile('print')) {
                    File::delete(storage_path('app/public/'.Auth::user()->uuid.'/prints/') . $jogo->print);
                    $jogo->print = $this->uploadFoto($request->print);
                }
                $jogo->titulo = $request->titulo;
                $jogo->plataforma = $request->plataforma;
                $jogo->publisher = $request->publisher;
                $jogo->exclusivo = $request->exclusivo;
                $jogo->repetido = $request->repetido;
                $jogo->dificuldade = $request->dificuldade;
                if ($request->platinado_em != '__/__/____') {
                    $jogo->situacao = 'Platinado';
                    $jogo->platinado_em = $request->platinado_em;
                } else {
                    $jogo->situacao = $request->situacao;
                    $jogo->platinado_em = null;
                }
                $jogo->guia1 = $request->guia1;
                $jogo->guia2 = $request->guia2;
                $jogo->save();
                DB::commit();
                return redirect()->back()->with(['tipo' => 'success', 'titulo' => 'Sucesso!', 'mensagem' => "Jogo atualizado!"]);
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with(['tipo' => 'error', 'titulo' => 'Deu Ruim!', 'mensagem' => $e->getMessage()])->withInput();
            }
        }
    }
    public function delete(Jogo $jogo){
        if($jogo->user_id <> Auth::user()->id){
            return redirect()->back();
        } else {
            DB::beginTransaction();
            try {
                if (!empty($jogo->print)) {
                    File::delete(storage_path('app/public/'.Auth::user()->uuid.'/prints/') . $jogo->print);
                }
                $jogo->delete();
                DB::commit();
                return redirect()->back()->with(['tipo' => 'success', 'titulo' => 'Sucesso', 'mensagem' => "Jogo apagado!"]);
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with(['tipo' => 'error', 'mensagem' => $e->getMessage()]);
            }
        }
    }
    public function galeria(){
        $galeria = $this->jogo->whereNotNull('print')->orderBy('id', 'ASC')->paginate(21);
        return view('restrita.jogo.galeria', compact('galeria'));
    }


    public function nomeFoto($foto){
        $nome = uniqid(time()) . '.'. $foto->getClientOriginalExtension();
        $dir = storage_path('app/public/'.Auth::user()->uuid.'/prints/');

        if(file_exists($dir . $nome)){
            return $this->nomeFoto($foto);
        }
        return $nome;
    }
    protected function uploadFoto($foto){
        $nome  =  $this->nomeFoto($foto);
        $caminho = storage_path('app/public/'.Auth::user()->uuid.'/prints/') . $nome;
        Image::make($foto->getRealPath())->resize(1000, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($caminho, 60, 'jpg');
        return $nome;
    }
}
