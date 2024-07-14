<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clube extends Model
{
    use HasFactory;

    protected $table = 'clubes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'divisao',
        'uniao',
        'associacao',
        'area',
        'regiao',
        'distrito',
        'igreja',
        'nome',
        'status'
    ];

    public function unidades()
    {
        return $this->hasMany(Unidade::class, 'id_clube');
    }
}
