<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Jogo extends Model
{
    use HasFactory;
    protected $table = 'jogos';
    protected $fillable = [
        'user_id',
        'titulo',
        'plataforma',
        'publisher',
        'exclusivo',
        'repetido',
        'dificuldade',
        'situacao',
        'platinado_em',
        'guia1',
        'guia2',
        'print'
    ];

    public function getCreatedAtAttribute(){
        return Carbon::parse($this->attributes['created_at'])->format('d/m/Y H:i:s');
    }
    public function getUpdatedAtAttribute(){
        return Carbon::parse($this->attributes['updated_at'])->format('d/m/Y H:i:s');
    }
    public function getPlatinadoEmAttribute(){
        if(!is_null($this->attributes['platinado_em'])){
            return Carbon::parse($this->attributes['platinado_em'])->format('d/m/Y');
        }
    }
    public function setPlatinadoEmAttribute($value){
        if(!is_null($value)){
            $this->attributes['platinado_em'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
        } else {
            $this->attributes['platinado_em'] = null;
        }
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
