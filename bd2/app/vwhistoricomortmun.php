<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vwhistoricomortmun extends Model
{
    protected $fillable = [
        'nome_municipio',
        'tmortalidade_municipio',
        'ano',
    ];
}
