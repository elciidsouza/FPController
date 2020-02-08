<?php

Auth::routes();

Route::get('/', function(){
    return view('auth.login');
});

Route::post('/logar', 'Auth\LoginController@loginNameOrEmail');

Route::group(['middleware' => 'auth'], function () {

    // All my routes that needs a logged in user
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/logout', 'HomeController@logout');
    Route::get('/', function () {
        return redirect('/home');
    });

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/imports/{pass}', 'ImportsAnimesController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/ganhos', 'GanhosController@index')->name('ganhos');
    Route::get('/ganhos/new/', 'GanhosController@formGanhos')->name('formGanhos');
    Route::post('/ganhos/send', 'GanhosController@sendGanhos')->name('sendGanhos');
    Route::get('/ganhos/delete/{id}', 'GanhosController@delete')->name('deleteGanhos');
    
    Route::get('/despesas', 'DespesasController@index')->name('despesas');
    Route::get('/despesas/new/', 'DespesasController@formDespesas')->name('formDespesas');
    Route::post('/despesas/send', 'DespesasController@sendDespesas')->name('sendDespesas');
    Route::get('/despesas/delete/{id}', 'DespesasController@delete')->name('deleteDespesas');
    
    Route::get('/cartoes', 'CartaoController@index')->name('cartoes');
    
    Route::get('/categorias', 'CategoriasController@index')->name('categorias');
    
    Route::get('/objetivos', 'ObjetivosController@index')->name('objetivos');
    
    Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

