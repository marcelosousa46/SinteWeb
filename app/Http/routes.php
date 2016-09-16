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
    Route::get('permissoes/gerar', 'PermissaoController@gerar');
    Route::controller('permissoes','PermissaoController',[
        'anyData'    => 'permissoes.data',
        'getIndex'   => 'permissoes',
        'getCreate'  => 'permissoes.create',
        'postStore'  => 'permissoes.store',
        'postUpdate' => 'permissoes.update',
    ]);
    /* Rotinas */
    Route::controller('rotinas','RotinaController',[
        'anyData'     => 'rotinas.data',
        'getIndex'    => 'rotinas',
        'postStore'   => 'rotinas.store',
        'postUpdate'  => 'rotinas.update',
    ]);
    /* Produtos */
    Route::controller('produtos','ProdutoController',[
        'anyData'          => 'produtos.data',
        'getIndex'         => 'produtos',
        'getCreate'        => 'produtos.create',
        'postStore'        => 'produtos.store',
        'postUpdate'       => 'produtos.update',
        'anyAutocomplete'  => 'produtos.autocomplete',
        'anyCodigo'        => 'produtos.codigo',
        'anyId'            => 'produtos.id',
    ]);
    /* Unidades */
    Route::controller('unidades','UnidadeController',[
        'anyData'     => 'unidades.data',
        'getIndex'    => 'unidades',
        'getCreate'   => 'unidades.create',
        'postStore'   => 'unidades.store',
        'postUpdate'  => 'unidades.update',
    ]);
    /* Generos */
    Route::controller('generos','GeneroController',[
        'anyData'     => 'generos.data',
        'getIndex'    => 'generos',
        'getCreate'   => 'generos.create',
        'postStore'   => 'generos.store',
        'postUpdate'  => 'generos.update',
    ]);
    /* NCMs */
    Route::controller('ncms','NcmController',[
        'anyData'     => 'ncms.data',
        'getIndex'    => 'ncms',
        'getCreate'   => 'ncms.create',
        'postStore'   => 'ncms.store',
        'postUpdate'  => 'ncms.update',
    ]);
    /* TipoItens */
    Route::controller('tipoitens','TipoitemController',[
        'anyData'     => 'tipoitens.data',
        'getIndex'    => 'tipoitens',
        'getCreate'   => 'tipoitens.create',
        'postStore'   => 'tipoitens.store',
        'postUpdate'  => 'tipoitens.update',
    ]);
    /* Natop */
    Route::controller('natop','NatopController',[
        'anyData'     => 'natop.data',
        'getIndex'    => 'natop',
        'getCreate'   => 'natop.create',
        'postStore'   => 'natop.store',
        'postUpdate'  => 'natop.update',
        'anyAutocomplete'  => 'natop.autocomplete',
        'anyId'            => 'natop.id',
    ]);
    /* Participantes */
    Route::controller('participante','ParticipanteController',[
        'anyData'      => 'participante.data',
        'getIndex'     => 'participante',
        'getCreate'    => 'participante.create',
        'postStore'    => 'participante.store',
        'postUpdate'   => 'participante.update',
        'anyDescricao' => 'participante.nome',
        'anyCodigo'    => 'participante.codigo',
    ]);
    /* Notas */
    Route::controller('nota','NotaController',[
        'anyData'     => 'nota.data',
        'getIndex'    => 'nota',
        'getCreate'   => 'nota.create',
        'postStore'   => 'nota.store',
        'postUpdate'  => 'nota.update',
        'anyGeranfe'  => 'nota.geranfe',
    ]);

});
