<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vwconsmortest extends Model
{
    protected $fillable = [
          'nome_estado',
          'tmortalidade_estado',
          'ano',
    ];
}
