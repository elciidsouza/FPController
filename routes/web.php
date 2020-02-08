<?php

Auth::routes();

Route::get('/', function(){
    return view('auth.login');
});

Route::group(['middleware' => 'auth'], function () {

    // All my routes that needs a logged in user
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/logout', 'HomeController@logout');
    Route::get('/', function () {
        return redirect('/home');
    });

    Route::get('/ganhos', 'GanhosController@index')->name('ganhos');
    Route::get('/ganhos/new/', 'GanhosController@formGanhos')->name('formGanhos');
    Route::post('/ganhos/send', 'GanhosController@sendGanhos')->name('sendGanhos');
    Route::get('/ganhos/delete/{id}', 'GanhosController@delete')->name('deleteGanhos');

    Route::get('/despesas', 'DespesasController@index')->name('despesas');
    Route::get('/despesas/new/', 'DespesasController@formDespesas')->name('formDespesas');
    Route::post('/despesas/send', 'DespesasController@sendDespesas')->name('sendDespesas');
    Route::get('/despesas/delete/{id}', 'DespesasController@delete')->name('deleteDespesas');

    Route::get('/cartoes', 'CartaoController@index')->name('cartoes');
    Route::get('/cartoes/new/', 'CartaoController@formCartoes')->name('formCartoes');
    Route::post('/cartoes/send', 'CartaoController@sendCartoes')->name('sendCartoes');
    Route::get('/cartoes/delete/{id}', 'CartaoController@delete')->name('deleteCartoes');

    Route::get('/categorias', 'CategoriasController@index')->name('categorias');
    Route::get('/categorias/new/', 'CategoriasController@formCategorias')->name('formCategorias');
    Route::post('/categorias/send', 'CategoriasController@sendCategorias')->name('sendCategorias');
    Route::get('/categorias/delete/{id}', 'CategoriasController@deleteCategorias')->name('deleteCategorias');

    Route::get('/objetivos', 'ObjetivosController@index')->name('objetivos');
    Route::get('/objetivos/new', 'ObjetivosController@formObjetivos')->name('formObjetivos');
    Route::post('/objetivos/send', 'ObjetivosController@sendObjetivos')->name('sendObjetivos');
    Route::get('/objetivos/delete/{id}', 'ObjetivosController@delete')->name('deleteObjetivos');
    Route::get('/objetivos/realizado/{id}', 'ObjetivosController@realizado')->name('realizadoObjetivos');


    Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

});

Auth::routes();
