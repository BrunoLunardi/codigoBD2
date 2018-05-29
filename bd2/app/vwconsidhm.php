<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vwconsidhm extends Model
{
    protected $fillable = [
          'nome_municipio',
          'sigla',
          'idhm',
          'ano',
          'classificacao',
    ];
}
