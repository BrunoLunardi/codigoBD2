<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class municipio extends Model
{
    private $id_municipio;
    private $nome_municipio;
    private $id_estado;

    protected $fillable = [
          'id_municipio',
          'nome_municipio',
          'id_estado',
    ];

}
