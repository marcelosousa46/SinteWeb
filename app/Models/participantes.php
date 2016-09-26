<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class participantes extends Model
{
    protected $table    = 'participantes';
    protected $fillable = ['id','codigo','nome','pais','bairro',
                           'cnpj','cpf','ie', 'municipio','ibge',
                           'suframa','endereco','numero','uf',
                           'complemento', 'bairro','email',
                           'cep','cpais','fone'];
}
