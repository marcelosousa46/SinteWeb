<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class participantes extends Model
{
    protected $table    = 'participantes';
    protected $fillable = ['id','codigo','nome','pais_id',
                           'cnpj','cpf','ie', 'municipio_id', 
                           'suframa','enereco','numero',
                           'complemento', 'bairro'];
}
