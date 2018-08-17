<?php

Route::get('/', 'SiteController@home')->name('home');

//Rotas do painel de administração para autores
Route::group(['prefix' => 'admin', 'middleware' => 'roles:author,admin'], function(){
    Route::get('/', 'SiteController@admin')->name('admin');
    //Notícias
    Route::get('/noticias', 'PostController@showPosts')->name('admin.posts');
    Route::get('/noticias/nova', 'PostController@showNewPostForm')->name('admin.posts.new');
    Route::post('/noticias', 'PostController@createPost')->name('admin.posts.create');
    Route::get('/noticias/excluir/{id}', 'PostController@deletePost')->name('admin.posts.delete');
    Route::get('/noticias/editar/{id}', 'PostController@showEditPostForm')->name('admin.posts.edit');
    Route::post('/noticias/editar/{id}', 'PostController@updatePost')->name('admin.posts.update');
    //Biblioteca
    Route::get('/biblioteca', 'WorkController@showWorks')->name('admin.works');
    Route::post('/biblioteca', 'WorkController@createWork')->name('admin.works.create');
    Route::get('/biblioteca/excluir/{id}', 'WorkController@deleteWork')->name('admin.works.delete');
});

//Rotas do painel de administração para administradores
Route::group(['prefix' => 'admin', 'middleware' => 'roles:admin'], function(){
    //Usuários
    Route::get('/usuarios', 'UserController@showUsers')->name('admin.users');
    Route::post('/usuarios', 'UserController@registerUser')->name('admin.users.register');
    Route::get('/usuarios/ativar/{id}', 'UserController@toggleUserActivation')->name('admin.users.activate');
    Route::get('/usuarios/novasenha/{id}', 'UserController@resetUserPassword')->name('admin.users.password');
    //Pessoas
    Route::get('/pessoas', 'SiteController@people')->name('admin.people');
});

//Rotas de autenticação
Route::group(['prefix' => 'login'], function(){
    Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/', 'Auth\LoginController@login');
});
Route::get('/logout', 'SiteController@logout')->name('logout');