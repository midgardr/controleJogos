<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Jogo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class JogoController extends Controller{
    private $jogo;
    private $plataformas = [
        'PS3',
        'PS4',
        'PSVita',
        'PS5'
    ];
    private $publishers = ['2Awesome','2Dream','505 Games','70 Times 7, LLC','A Crowd of Monsters','Activision Blizzard','Aksys Games','Apple','Aquiris Game Studio','Aria','Artifex Mundi','Atlus','Bandai Namco','Bethesda Softworks','Billy Goat Entertainment','Blowfish Studios','Capcom','Chubby Pixel','Circle Entertainment','Cococucumber','Coffee Stain Studios','Cooply Solutions','Crazy Monkey Studios','Creative Bytes Studios','Curve Digital','Daedalic Entertainment','Deep Silver','Devolver Digital','Digital Touch Co','Disney Interactive Studios','Double Eleven','Double Fine','Dramaticcreate', 'D3PUBLISHER Inc','EA','EastAsiaSoft','Ember Lab','Endemol Uk Limited','Entergram','Envolved Games','Fair Play Labs','Focus Home Interactive','Frozenbyte','Fullbright','Funbox Media','Gamemill Entertainment','Gammera Nest','Gearbox','Gnomic Studios','Google','Granzella','Green Lava Studios','Groovy Milk','Ground Shatter','Harukaze','Hunex','Infinite Madaa','Intragames','Ivanovich Games','JP: Idea Factory','Kalypso Media Digital','Kingdom Media','Koei Tecmo','Konami','Level 77 Pty','Lightwood Games','Lillymo Games','Lucas Arts','Merge Games Limited','MichaelArts','Microsoft','Mighty Rabbit Studios','NIS America','National Westminster Bank','Necrophone Games','NetEase','NiKo MaKi','Nintendo','Nippon Ichi Software','Oasis Games','Otterrific Games','Outra','Owlgorithm','PQube','Paradox Interactive','Phosphor Games','Pixel Maniacs','Playrise Digital','Product ID','Prototype','Psyonix','Radial Games','Rain Games','Rainy Night Creations','Ratalaika Games', 'Rebellion Developments', 'Rockin Heart Games','SakuraGame','Sega','Shanghai Kena','Slang','Slitherine Strategies','Smobile','Soedesco','Sometimes You','Sony','Spike Chunsoft','Sprite','Square-Enix','Studio MDHR','THQ','Take-Two','Team Cherry','Telltale Games','Tencent Games','Top Rated','Ubisoft','Unfinished Pixel','VRWERX','Vector Unit','Victory Road','Vision Games','Wales Interactive','Warner Bros.','Wired Productions','X.D. Network Inc','Zen Studios','Zodiac Interactive','S.R.L. RandomSpin-Games', 'Young Horses'];
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
        $metricas['todosJogos'] = $queryMetricas->where('user_id', Auth::user()->id)->count();
        $metricas['jogando'] = $queryMetricas->where('user_id', Auth::user()->id)->where('situacao', 'Jogando')->count();
        $metricas['exclusivos'] = $queryMetricas->where('user_id', Auth::user()->id)->where('exclusivo', 1)->count();
        $metricas['multiplataformas'] = $queryMetricas->where('user_id', Auth::user()->id)->where('exclusivo', 0)->count();
        $metricas['naoPlatinados'] = $queryMetricas->where('user_id', Auth::user()->id)->where('situacao', '<>', 'Platinado')->count();
        $metricas['platinados'] = $queryMetricas->where('user_id', Auth::user()->id)->where('situacao', 'Platinado')->count();
        $metricas['ineditos'] = $queryMetricas->where('user_id', Auth::user()->id)->where('repetido', 0)->count();
        $metricas['repetidos'] = $queryMetricas->where('user_id', Auth::user()->id)->where('repetido', 1)->count();
        $metricas['naoLancados'] = $queryMetricas->where('user_id', Auth::user()->id)->where('situacao', 'Não lançado')->count();
        $metricas['naoComprados'] = $queryMetricas->where('user_id', Auth::user()->id)->where('situacao', 'Não comprado')->count();
        $metricas['desistidos'] = $queryMetricas->where('user_id', Auth::user()->id)->where('situacao', 'Desistido')->count();
        $metricas['naoGarapas'] = $queryMetricas->where('user_id', Auth::user()->id)->where('dificuldade', '<>', 'Garapa')->count();
        $metricas['somenteGuia'] = $queryMetricas->where('user_id', Auth::user()->id)->where('guia1', '<>', '')->count();

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
            $queryJogos->where('guia1', '<>', '');
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
            if (!empty($request->platinado_em)) {
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
            $jogo->observacoes = $request->observacoes;
            $jogo->save();
            return redirect()->route('jogo.edit', $jogo)->with(['tipo'=>'success', 'titulo'=>'Sucesso!', 'mensagem'=>"Novo jogo inserido!"]);
        } catch (\Exception $e){
            return redirect()->back()->with(['tipo'=>'error', 'titulo'=>'Deu Ruim!', 'mensagem'=>$e->getMessage()])->withInput();
        }
    }

    public function edit(Jogo $jogo){
        if($jogo->user_id != Auth::user()->id){
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
        if($jogo->user_id != Auth::user()->id){
            return redirect()->back();
        } else {
            try {
                if ($request->hasFile('print')) {
                    File::delete('uploads/'.Auth::user()->uuid.'/prints/' . $jogo->print);
                    $jogo->print = $this->uploadFoto($request->print);
                }
                $jogo->titulo = $request->titulo;
                $jogo->plataforma = $request->plataforma;
                $jogo->publisher = $request->publisher;
                $jogo->exclusivo = $request->exclusivo;
                $jogo->repetido = $request->repetido;
                $jogo->dificuldade = $request->dificuldade;
                if (!empty($request->platinado_em)) {
                    $jogo->situacao = 'Platinado';
                    $jogo->platinado_em = $request->platinado_em;
                } else {
                    $jogo->situacao = $request->situacao;
                    $jogo->platinado_em = null;
                }
                $jogo->guia1 = $request->guia1;
                $jogo->guia2 = $request->guia2;
                $jogo->observacoes = $request->observacoes;
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
        if($jogo->user_id != Auth::user()->id){
            return redirect()->back();
        } else {
            DB::beginTransaction();
            try {
                if (!empty($jogo->print)) {
                    File::delete('uploads/'.Auth::user()->uuid.'/prints/' . $jogo->print);
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
        $this->user = User::find(Auth::user()->id);
        $galeria = $this->jogo->where('user_id', Auth::user()->id)->whereNotNull('print')->orderBy('id', 'ASC')->paginate(21);
        return view('restrita.jogo.galeria', compact('galeria'));
    }


    public function nomeFoto($foto){
        $nome = uniqid(time()) . '.'. $foto->getClientOriginalExtension();
        $dir = 'upload/'.Auth::user()->uuid.'/prints/';

        if(file_exists($dir . $nome)){
            return $this->nomeFoto($foto);
        }
        return $nome;
    }
    protected function uploadFoto($foto){
        $nome  =  $this->nomeFoto($foto);
        $caminho = 'uploads/'.Auth::user()->uuid.'/prints/' . $nome;
        Image::make($foto->getRealPath())->resize(1000, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($caminho, 60, 'jpg');
        return $nome;
    }

    public function listPublishers(){
        return count($this->publishers);
    }
}
