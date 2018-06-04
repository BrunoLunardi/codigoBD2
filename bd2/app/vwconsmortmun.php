<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vwconsmortmun extends Model
{
    protected $fillable = [
          'nome_municipio',
          'sigla',
          'tmortalidade_municipio',
          'ano',
    ];
}
