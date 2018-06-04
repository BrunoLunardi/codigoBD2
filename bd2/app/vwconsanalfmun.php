<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vwconsanalfmun extends Model
{
    protected $fillable = [
          'nome_municipio',
          'sigla',
          'tanalfabetismo_municipio',
          'ano',
    ];
}
