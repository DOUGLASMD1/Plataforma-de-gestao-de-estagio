<?php

use Illuminate\Http\Request;

Route::post('/login', 'Api\UserController@login');

Route::middleware('auth:api')->group( function () {
	Route::post('/register-coordenador', 'Api\CoordenadorController@register');
    Route::post('/register-aluno', 'Api\AlunoController@register');
    Route::post('/register-supervisor', 'Api\SupervisorController@register');
    Route::get('/user', 'Api\UserController@userDetails');
});
        