<?php

use Illuminate\Http\Request;

Route::post('/biblioteca/imagem', 'WorkController@imageUpload');
Route::post('/noticias/imagem', 'PostController@imageUpload');
