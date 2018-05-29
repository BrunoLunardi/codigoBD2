<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class indicativos_municipio extends Model
{
    private $id_municipio;
    private $tmortalidade_municipio;
    private $tanalfabetismo_municipio;
    private $tidhm;
    private $trendapercapita_municipio;
    private $ano;
    private $classificacao;

        protected $fillable = [
              'id_estado',
              'tmortalidade_municipio',
              'tanalfabetismo_municipio',
              'tidhm',
              'trendapercapita_municipio',
              'ano',
              'classificacao',
        ];
}
