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
      View::composer(['layouts.sidebar','permissoes.permissoes'], function($view)
            {
                if (!Auth::guest()){
                    $this->menu = Auth::user()->Rotinas();
                    $view->with('menu', $this->menu);
                    if (!empty($this->menu)){
                        $this->submenu = Auth::user()->Subrotinas($this->menu[0]->id);
                        $view->with('submenu', $this->submenu);
                    }    
                 }
            });
      View::composer('permissoes.permissoes', function($view)
            {
              $json = '[{';
              foreach ($this->menu as $ro){
                 $menu = '"text":'.'"'.$ro->descricao.'"'.',';
                 $submenu = '"nodes": [';
                 foreach ($this->submenu as $su){
                    $submenu = $submenu .'{'.'"text": "'.$su->descricao.'"'.'},';
                 }
                 $submenu = substr($submenu,0,-1).']';
              }
              $json = $json.$menu.$submenu.'}]';
              $view->with('json', $json);
            });
    }

    public function register()
    {
        //
    }
}
