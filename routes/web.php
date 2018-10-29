<?php

//Rotas so portal
Route::get('/', 'SiteController@home')->name('home');
Route::get('/noticia/{url}', 'SiteController@post')->name('post');
Route::get('/noticias', 'SiteController@posts')->name('posts');
Route::get('/biblioteca', 'SiteController@works')->name('works');
Route::get('/ajuda', 'SiteController@help')->name('help');
Route::get('/quemsomos', 'SiteController@team')->name('team');
Route::get('/parceiros', 'SiteController@partners')->name('partners');
Route::get('/eventos', 'SiteController@events')->name('events');

//Rotas do portal de administração do site para usuários com a role author
Route::group(['prefix' => 'admin', 'middleware' => 'roles:author'], function(){

	//Destaques
	Route::get('/', 'SiteController@admin')->name('admin');
	Route::group(['prefix' => 'destaques'], function(){
		Route::get('/', 'FeaturedController@showFeatured')->name('admin.featured');
		Route::group(['prefix' => 'noticia'], function(){
			Route::post('/adicionar', 'FeaturedController@createFeaturedPost')->name('admin.featured.post.create');
			Route::get('/remover/{id}', 'FeaturedController@deleteFeaturedPost')->name('admin.featured.post.delete');
		});
		Route::group(['prefix' => 'video'], function(){
			Route::post('/adicionar', 'FeaturedController@createFeaturedVideo')->name('admin.featured.video.create');
			Route::get('/remover/{id}', 'FeaturedController@deleteFeaturedVideo')->name('admin.featured.video.delete');
		});
	});

	//Notícias
    Route::group(['prefix' => 'noticias'], function(){
        Route::get('/', 'PostController@showPosts')->name('admin.posts');
        Route::post('/', 'PostController@createPost')->name('admin.posts.create');
        Route::get('/nova', 'PostController@showNewPostForm')->name('admin.posts.new');
        Route::get('/excluir/{id}', 'PostController@deletePost')->name('admin.posts.delete');
        Route::get('/editar/{id}', 'PostController@showEditPostForm')->name('admin.posts.edit');
        Route::post('/editar/{id}', 'PostController@updatePost')->name('admin.posts.update');
	});

	//Perfil
	Route::group(['prefix' => 'perfil'], function(){
        Route::get('/', 'UserController@showProfileForm')->name('admin.profile');
        Route::post('/', 'UserController@updateProfile')->name('admin.profile.update');
	});
	
	//Biblioteca
    Route::group(['prefix' => 'biblioteca'], function(){
        Route::get('/', 'WorkController@showWorks')->name('admin.works');
        Route::post('/', 'WorkController@createWork')->name('admin.works.create');
        Route::get('/excluir/{id}', 'WorkController@deleteWork')->name('admin.works.delete');
	});
	
	//Eventos
    Route::group(['prefix' => 'eventos'], function(){
        Route::get('/', 'EventController@showEvents')->name('admin.events');
        Route::post('/', 'EventController@createEvent')->name('admin.events.create');
        Route::get('/excluir/{id}', 'EventController@deleteEvent')->name('admin.events.delete');
    });
});

//Rotas do portal de administração do site para usuários com a role admin
Route::group(['prefix' => 'admin', 'middleware' => 'roles:admin'], function(){

	//Usuários
	Route::group(['prefix' => 'usuarios'], function(){
		Route::get('/', 'UserController@showUsers')->name('admin.users');
		Route::post('/', 'UserController@registerUser')->name('admin.users.register');
		Route::get('/ativar/{id}', 'UserController@toggleUserActivation')->name('admin.users.activate');
		Route::get('/novasenha/{id}', 'UserController@resetUserPassword')->name('admin.users.password');
	});

	//Pessoas
	Route::group(['prefix' => 'pessoas'], function(){
		Route::get('/', 'PersonController@showPeople')->name('admin.people');
		Route::post('/', 'PersonController@createPerson')->name('admin.people.create');
		Route::get('/excluir/{id}', 'PersonController@deletePerson')->name('admin.people.delete');
	});
});

//ROTAS DE AUTENTICAÇÃO
Route::group(['prefix' => 'login', 'namespace' => 'Auth'], function(){
    Route::get('/', 'LoginController@showLoginForm')->name('login');
    Route::post('/', 'LoginController@login');
});
Route::get('/logout', 'SiteController@logout')->name('logout');

//Rotas para executar as migrations e seeds caso necessário
Route::get('/artisan/{command}', 'SiteController@runArtisanCommand');