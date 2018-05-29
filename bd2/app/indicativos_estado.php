<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class indicativos_estado extends Model
{
    protected $fillable = [
          'id_estado',
          'tmortalidade_estado',
          'tanalfabetismo_estado',
          'tidh',
          'trendapercapita_estado',
          'ano',
          'classificacao',
    ];
}
