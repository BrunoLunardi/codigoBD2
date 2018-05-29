<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vwindicativosmunest extends Model
{
    protected $fillable = [
          'id_estado',
          'nome_estado',
          'id_municipio',
          'nome_municipio',
          'tmortalidade_municipio',
          'tanalfabetismo_municipio',
          'tidhm',
          'trendapercapita_municipio',
          'ano',
          'classificacao',
    ];
}
