<?php

Route::get('/', 'SiteController@home')->name('home');

//ADMIN
Route::group(['prefix' => 'admin', 'middleware' => 'roles:author'], function(){

    Route::get('/', 'SiteController@admin')->name('admin');

    Route::group(['prefix' => 'perfil'], function(){
        Route::get('/', 'UserController@showProfileForm')->name('admin.profile');
        Route::post('/', 'UserController@updateProfile')->name('admin.profile.update');
    });

    Route::group(['prefix' => 'noticias'], function(){
        Route::get('/', 'PostController@showPosts')->name('admin.posts');
        Route::post('/', 'PostController@createPost')->name('admin.posts.create');
        Route::get('/nova', 'PostController@showNewPostForm')->name('admin.posts.new');
        Route::get('/excluir/{id}', 'PostController@deletePost')->name('admin.posts.delete');
        Route::get('/editar/{id}', 'PostController@showEditPostForm')->name('admin.posts.edit');
        Route::post('/editar/{id}', 'PostController@updatePost')->name('admin.posts.update');
    });

    Route::group(['prefix' => 'biblioteca'], function(){
        Route::get('/', 'WorkController@showWorks')->name('admin.works');
        Route::post('/', 'WorkController@createWork')->name('admin.works.create');
        Route::get('/excluir/{id}', 'WorkController@deleteWork')->name('admin.works.delete');
    });
   
    Route::group(['prefix' => 'eventos'], function(){
        Route::get('/', 'EventController@showEvents')->name('admin.events');
        Route::post('/', 'EventController@createEvent')->name('admin.events.create');
        Route::get('/excluir/{id}', 'EventController@deleteEvent')->name('admin.events.delete');
    });

    //ROTAS QUE REQUEREM A ROLE ADMIN
    Route::group(['middleware' => 'roles:admin'], function(){

        Route::group(['prefix' => 'usuarios'], function(){
            Route::get('/', 'UserController@showUsers')->name('admin.users');
            Route::post('/', 'UserController@registerUser')->name('admin.users.register');
            Route::get('/ativar/{id}', 'UserController@toggleUserActivation')->name('admin.users.activate');
            Route::get('/novasenha/{id}', 'UserController@resetUserPassword')->name('admin.users.password');
        });

        Route::group(['prefix' => 'pessoas'], function(){
            Route::get('/', 'PersonController@showPeople')->name('admin.people');
            Route::post('/', 'PersonController@createPerson')->name('admin.people.create');
            Route::get('/{id}', 'PersonController@deletePerson')->name('admin.people.delete');
        });
        
    });

});

//ROTAS DE AUTENTICAÇÃO
Route::group(['prefix' => 'login', 'namespace' => 'auth'], function(){
    Route::get('/', 'LoginController@showLoginForm')->name('login');
    Route::post('/', 'LoginController@login');
});
Route::get('/logout', 'SiteController@logout')->name('logout');