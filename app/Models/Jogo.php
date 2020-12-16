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

    public function user(){
        return $this->belongsTo(User::class);
    }
}
