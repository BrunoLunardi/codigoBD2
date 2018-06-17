<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vwconsrendapcapmun extends Model
{
    protected $fillable = [
          'nome_municipio',
          'sigla',
          'trendapercapita_municipio',
          'ano',
    ];
}
