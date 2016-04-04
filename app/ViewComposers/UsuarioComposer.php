<?php
namespace App\ViewComposers;

class UsuarioComposer {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function compose($view)
    {
        $usuarios = User::all();
        dd($usuarios);
        $view->with(compact('usuarios'));
    }

}
