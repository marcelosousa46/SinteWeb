<?php
namespace App\classes;

use App\Models\titulos;

/**
* Classe de iterrelacionamento com os titulso
*/
class interTitulos
{
	public function relacionar($conteudo, $numdoc, $i){
         
        $titulo = new titulos([
	        'tipo'     => 'R',
	        'codigo'   => $numdoc.'-'.$i,
	        'dt_doc'   => $conteudo->dt_doc,
	        'situacao' => 'A'
        ]);

        return $titulo;
    }	
}