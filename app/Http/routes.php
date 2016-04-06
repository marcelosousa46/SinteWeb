<?php

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('welcome');
    });

});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');

    /* Usuários */
    Route::controller('usuarios','UserController',[
        'anyData'     => 'usuarios.data',
        'getIndex'    => 'usuarios',
        'getCreate'   => 'usuarios.create',
        'postStore'   => 'usuarios.store',
        'getDestroy'  => 'usuarios.destroy',
        'postUpdate'  => 'usuarios.update',
    ]);
    /* Permissoes */
    Route::controller('permissoes','PermissaoController',[
        'anyData'     => 'permissoes.data',
        'getIndex'    => 'permissoes',
        'getCreate'   => 'permissoes.create',
        'postStore'   => 'permissoes.store',
        'postUpdate'  => 'permissoes.update',
    ]);
    /* Rotinas */
    Route::controller('rotinas','RotinaController',[
        'anyData'     => 'rotinas.data',
        'getIndex'    => 'rotinas',
        'postStore'   => 'rotinas.store',
        'postUpdate'  => 'rotinas.update',
    ]);

});
