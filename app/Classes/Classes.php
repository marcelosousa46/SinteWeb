<?php
namespace App\Classes;

use Validator;
use Illuminate\Http\Request;
use App\User;
use App\Models\Rotinas;
use App\Models\Permissoes;
use App\Models\Unidades;
use App\Models\Tipoitens;
use App\Models\Ncms;
use App\Models\Generos;
use App\Models\Series;
use App\Models\fpagamentos;
use DB;

class Classes {
    public function getPermissao($request,$tipo)
    {
       $autorizado = false;
       if ($request->session()->has('rotina_id')) {
          $crud = auth()->user()->Crud(session('rotina_id'));
          $autorizacao = $crud[0]->liberado;
          if ($autorizacao != 'A')
          {
             if ($tipo == 'A')
             {
               $autorizacao = $crud[0]->alterar;
             }elseif ($tipo == 'I') {
               $autorizacao = $crud[0]->incluir;
             }elseif ($tipo == 'E') {
               $autorizacao = $crud[0]->excluir;
             }
          }   
        }
        if ($autorizacao == 'A'){
        	 $autorizado = true;
        }
        return $autorizado;
     }
     public function gerarPermissoes($user_id)
     {
        $gerado = false;
        $rotinas = Rotinas::all();
        foreach ($rotinas as $value) {

          $retorno = DB::table('permissoes')
                         ->select('*')
                         ->where('users_id', $user_id)
                         ->where('rotinas_id', $value->id)
                         ->get();
          if ($retorno == null)
          {     
            $permissao = new Permissoes;
            $permissao->users_id   = $user_id;
            $permissao->rotinas_id = $value->id;
            $permissao->liberado   = 'A';
            $permissao->incluir    = 'A';
            $permissao->alterar    = 'A';
            $permissao->consultar  = 'A';
            $permissao->excluir    = 'A';
            $permissao->save();
          }  
        }
        $gerado = true;
        return $gerado;
     }
     public function getValor($valor)
     {
       if (strpos($valor,','))
       {
         $valor     = str_replace(array('.',','),array('','.'),$valor);
       }
       return $valor;
     }
     public function getUnidades()
     {
        $i = 0;
        $unidades = Unidades::all();
        foreach ($unidades as $a) {
          $retorno_unidades[$a->id] = $a->descricao;
          $i++;
        }
        return $retorno_unidades;
     }
     public function getTipoitens()
     {
        $i = 0;
        $itens = Tipoitens::all();
        foreach ($itens as $a) {
          $retorno_itens[$a->id] = $a->codigo." - ".$a->descricao;
          $i++;
        }
        return $retorno_itens;
     }
     public function getNcms()
     {
        $i = 0;
        $ncms = Ncms::all();
        foreach ($ncms as $a) {
          $retorno_ncms[$a->id] = $a->codigo." - ".$a->descricao;
          $i++;
        }
        return $retorno_ncms;
     }
     public function getGeneros()
     {
        $i = 0;
        $generos = Generos::all();
        foreach ($generos as $a) {
          $retorno_generos[$a->id] = $a->codigo." - ".$a->descricao;
          $i++;
        }
        return $retorno_generos;
     }
     public function getSeries()
     {
        $i = 0;
        $series = Series::all();
        foreach ($series as $a) {
          $retorno_series[$a->id] = $a->id." - ".$a->descricao;
          $i++;
        }
        return $retorno_series;
     }
     public function numeroNota($id)
     {
        $numeronota = Series::find($id)->ultimo + 1;
        Series::find($id)->update(['ultimo' => $numeronota]);
        return $numeronota;
     }
     public function getFpagamentos()
     {
        $i = 0;
        $formas = Fpagamentos::all();
        foreach ($formas as $a) {
          $retorno_formas[$a->id] = $a->descricao;
          $i++;
        }
        return $retorno_formas;
     }
}
