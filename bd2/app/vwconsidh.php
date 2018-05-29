<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vwconsidh extends Model
{
  protected $fillable = [
        'nome_estado',
        'idh',
        'ano',
        'classificacao',
  ];
}
