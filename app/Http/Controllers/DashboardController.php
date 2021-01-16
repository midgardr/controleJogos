<?php

namespace App\Http\Controllers;

use App\Models\Jogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private $jogo;
    public function __construct(Jogo $jogo){
        $this->jogo = $jogo;
    }
    public function dashboard(){
        $metricas = [];
        $metricas['jogosAdquiridos'] = $this->jogo->whereNotIn('situacao', ['Não lançado', 'Não comprado'])->count();
        $metricas['platinados'][0] = $this->jogo->where('situacao', 'Platinado')->count();
        $metricas['platinados'][1] = round($metricas['platinados'][0]*100/$metricas['jogosAdquiridos']);
        $metricas['naoPlatinados'][0] = $this->jogo->whereNotIn('situacao', ['Não lançado', 'Não comprado', 'Platinado'])->count();
        $metricas['naoPlatinados'][1] = round($metricas['naoPlatinados'][0]*100/$metricas['jogosAdquiridos']);
        $metricas['exclusivos'][0] = $this->jogo->where('exclusivo', 1)->count();
        $metricas['exclusivos'][1] = round($metricas['exclusivos'][0]*100/$metricas['jogosAdquiridos']);
        $metricas['multiplataformas'][0] = $this->jogo->where('exclusivo', 0)->count();
        $metricas['multiplataformas'][1] = round($metricas['multiplataformas'][0]*100/$metricas['jogosAdquiridos']);
        $metricas['unicos'][0] = $this->jogo->where('repetido', 0)->count();
        $metricas['unicos'][1] = round($metricas['unicos'][0]*100/$metricas['jogosAdquiridos']);
        $metricas['repetidos'][0] = $this->jogo->where('repetido', 1)->count();
        $metricas['repetidos'][1] = round($metricas['repetidos'][0]*100/$metricas['jogosAdquiridos']);
        $metricas['indiceCompletude'] = round($metricas['platinados'][0]*100/$metricas['jogosAdquiridos']);

        $graficos = [];
        $graficos['jogosPorPlataformas'] = DB::table('jogos')->selectRaw('plataforma, COUNT(*) AS qtd')->groupBy('plataforma')->orderBy('qtd', 'DESC')->get();
        $graficos['jogosPorPublishers'] = DB::table('jogos')->selectRaw('publisher, COUNT(*) AS qtd')->groupBy('publisher')->orderBy('qtd', 'DESC')->get();
        $graficos['jogosExclusivos'] = DB::table('jogos')->selectRaw('(CASE WHEN exclusivo = 1 THEN "EXCLUSIVO" ELSE "MULTIPLATAFORMA" END) AS exclusividade, COUNT(*) AS qtd')->groupBy('exclusividade')->orderBy('qtd', 'DESC')->get();
        $graficos['jogosPorDificuldade'] = DB::table('jogos')->selectRaw('dificuldade, COUNT(*) AS qtd')->groupBy('dificuldade')->orderBy('qtd', 'DESC')->get();
        $graficos['jogosUnicos'] = DB::table('jogos')->selectRaw('(CASE WHEN repetido = 1 THEN "REPETIPO" ELSE "ÚNICO" END) AS unicidade, COUNT(*) AS qtd')->groupBy('unicidade')->orderBy('qtd', 'DESC')->get();
        $graficos['jogosPorSituacao'] = DB::table('jogos')->selectRaw('situacao, COUNT(*) AS qtd')->groupBy('situacao')->orderBy('qtd', 'DESC')->get();
        $graficos['platinasPorMes'] = DB::table('jogos')->selectRaw('MONTH(platinado_em) AS mes_numero, (CASE WHEN MONTH(platinado_em)=1 THEN "JAN" WHEN MONTH(platinado_em)=2 THEN "FEV" WHEN MONTH(platinado_em)=3 THEN "MAR" WHEN MONTH(platinado_em)=4 THEN "ABR" WHEN MONTH(platinado_em)=5 THEN "MAI" WHEN MONTH(platinado_em)=6 THEN "JUN" WHEN MONTH(platinado_em)=7 THEN "JUL" WHEN MONTH(platinado_em)=8 THEN "AUG" WHEN MONTH(platinado_em)=9 THEN "SET" WHEN MONTH(platinado_em)=10 THEN "OUT" WHEN MONTH(platinado_em)=11 THEN "NOV" ELSE "DEZ" END) AS mes_texto, COUNT(*) as qtd')->groupBy('mes_numero', 'mes_texto')->orderBy('mes_numero', 'ASC')->get();
        $graficos['platinasPorAno'] = DB::table('jogos')->selectRaw('YEAR(platinado_em) AS ano, COUNT(*) as qtd')->groupBy('ano')->orderBy('ano', 'ASC')->get();
        //return $graficos;
        return view('restrita.dashboard', compact(['metricas', 'graficos']));
    }
}
