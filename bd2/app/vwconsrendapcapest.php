<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vwconsrendapcapest extends Model
{
    protected $fillable = [
          'nome_estado',
          'trendapercapita_estado',
          'ano',
    ];
}
