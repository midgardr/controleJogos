<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    private $categorias = [
        'DICAS DE PLATINA',
        'CURIOSIDADE DE PLATINA',
        'EXPOSED DE PLATINA',
        'PLANTÃO DE PLATINA',
        'ESPECIAL DE PLATINA',
        'RECADO DE PLATINA',
        'LIVE DE PLATINA'
    ];
    public function publica(Request $request){
        $categorias = $this->categorias;
        $query = Video::orderBy('id', 'DESC');
        if(!empty($request->categoria)){
            $query->where('categoria', $request->categoria);
        }
        if(!empty($request->titulo)){
            $query->where('titulo', 'LIKE', '%'.$request->titulo.'%');
        }
        $videos = $query->paginate(9);
        return view('index', compact('videos', 'categorias'));
    }
    public function index(Request $request){
        $categorias = $this->categorias;
        $query = Video::orderBy('id');
        if(!empty($request->categoria)){
            $query->where('categoria', $request->categoria);
        }
        if(!empty($request->titulo)){
            $query->where('titulo', 'LIKE', '%'.$request->titulo.'%');
        }
        $videos = $query->paginate(30);
        return view('adm.videos.index', compact('videos', 'categorias'));
    }
    public function create(){
        $categorias = $this->categorias;
        return view('adm.videos.dados', compact('categorias'));
    }
    public function store(Request $request){
        $video = Video::create($request->all());
        return redirect()->route('video.edit', $video)->with(['tipo'=>'success', 'titulo'=>'Sucesso!', 'mensagem'=>"Novo vídeo inserido!"]);
    }
    public function edit(Video $video){
        $categorias = $this->categorias;
        return view('adm.videos.dados', compact('video', 'categorias'));
    }
    public function update(Request $request, Video $video){
        $video->update($request->all());
        return redirect()->route('video.edit', $video)->with(['tipo'=>'success', 'titulo'=>'Sucesso!', 'mensagem'=>"Vídeo atualizado!"]);
    }
    public function delete(Video $video){
        $video->delete();
        return redirect()->route('video.index')->with(['tipo'=>'success', 'titulo'=>'Sucesso!', 'mensagem'=>"Vídeo excluído!"]);
    }
}
