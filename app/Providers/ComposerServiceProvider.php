<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth, View;
use App\Models\Permissoes;

class ComposerServiceProvider extends ServiceProvider
{
    protected $menu;
    protected $submenu;
    protected $json;

    public function boot()
    {
      View::composer(['layouts.sidebar','permissoes.permissoes','permissoes.permissoes-new-edit'], function($view)
          {
              if (!Auth::guest()){
                  $this->menu = Auth::user()->Rotinas();
                  $view->with('menu', $this->menu);
                  if (!empty($this->menu)){
                      $this->submenu = Auth::user()->Subrotinas($this->menu[0]->id);
                      $view->with('submenu', $this->submenu);
                      $i = 0;
                      foreach ($this->menu as $a) {
                        $retorno_de_rotinas[$a->id] = $a->descricao;
                        $i++;
                      }
                      foreach ($this->submenu as $a) {
                        $retorno_de_rotinas[$a->id] = $a->descricao;
                        $i++;
                      }
//                      dd($retorno_de_rotinas);
                      $view->with('retorno_de_rotinas', $retorno_de_rotinas);
                  }    
               }
          });
    }

    public function register()
    {
        //
    }
}
